<?php

namespace App\Http\Controllers;

use App\Models\Destination;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use PhpOffice\PhpSpreadsheet\IOFactory;

class DestinationController extends Controller
{
    /**
     * Display a listing of destinations.
     */

    public function getBoardingPoints()
    {
        $points = Destination::select('boarding_point')
            ->distinct()
            ->orderBy('boarding_point')
            ->pluck('boarding_point');

        return response()->json([
            'boarding_points' => $points
        ]);
    }

    public function getDestinations(Request $request)
    {
        $request->validate([
            'boarding_point' => 'required|string'
        ]);

        $destinations = Destination::where('boarding_point', $request->boarding_point)
            ->select('destination_point')
            ->distinct()
            ->orderBy('destination_point')
            ->pluck('destination_point');

        return response()->json([
            'boarding_point' => $request->boarding_point,
            'destination_points' => $destinations
        ]);
    }

    public function getFareDetails(Request $request)
{
    $request->validate([
        'boarding_point' => 'required|string',
        'destination_point' => 'required|string',
    ]);

    $destination = Destination::where('boarding_point', $request->boarding_point)
        ->where('destination_point', $request->destination_point)
        ->first();

    if (!$destination) {
        return response()->json([
            'message' => 'No fare details found for the given route.'
        ], 404);
    }

    return response()->json([
        'boarding_point' => $destination->boarding_point,
        'destination_point' => $destination->destination_point,
        'total_fare_alto' => $destination->total_fare_alto,
        'total_fare_sedan' => $destination->total_fare_sedan,
        'total_fare_ertiga' => $destination->total_fare_ertiga,
        'booking_amount_alto' =>$destination->min_booking_alto,
        'booking_amount_sedan' => $destination->min_booking_sedan,
        'booking_amount_ertiga' => $destination->min_booking_ertiga,
        'driver_fare_alto' => $destination->driver_fare_alto,
        'driver_fare_sedan' => $destination->driver_fare_sedan,
        'driver_fare_ertiga' => $destination->driver_fare_ertiga,
        'commission_alto' => $destination->commission_alto,
        'commission_sedan' => $destination->commission_sedan,
        'commission_ertiga' => $destination->commission_ertiga,
        'distance' => $destination->distance,
        'destination_range' => $destination->destination_range
    ]);
}

    public function index()
    {
        $destinations = Destination::all();
        return view('screen.destination.destinations', compact('destinations'));
    }

    /**
     * Show the form for creating a new destination.
     */
    public function create()
    {
        return view('screen.destination.createdestination');
    }

    /**
     * Store a newly created destination in storage.
     */
    public function store(Request $request)
    {
        // Debug the request data
        \Log::debug('Destination store method called');
        \Log::debug('Request data:', $request->all());
        
        // Validate the request
        $validator = Validator::make($request->all(), [
            'boarding_point' => 'required|string|max:255',
            'destination_point' => 'required|string|max:255',
            'distance' => 'required|numeric|min:0',
            'destination_range' => 'required|string|regex:/^\s*(\d+(?:\.\d+)?)\s*-\s*(\d+(?:\.\d+)?)\s*$/',
            'commission_alto' => 'required|numeric|min:0',
            'commission_sedan' => 'required|numeric|min:0',
            'commission_ertiga' => 'required|numeric|min:0',
            'total_fare_alto' => 'required|numeric|min:0',
            'total_fare_sedan' => 'required|numeric|min:0',
            'total_fare_ertiga' => 'required|numeric|min:0',
            'min_booking_alto' => 'required|numeric|min:0',
            'min_booking_sedan' => 'required|numeric|min:0',
            'min_booking_ertiga' => 'required|numeric|min:0',
            'driver_fare_alto' => 'required|numeric|min:0',
            'driver_fare_sedan' => 'required|numeric|min:0',
            'driver_fare_ertiga' => 'required|numeric|min:0',
            'is_enabled' => 'boolean',
        ]);

        if ($validator->fails()) {
            \Log::debug('Validation failed:', $validator->errors()->toArray());
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        // Extract range values for additional validation
        $rangePattern = '/^\s*(\d+(?:\.\d+)?)\s*-\s*(\d+(?:\.\d+)?)\s*$/';
        preg_match($rangePattern, $request->destination_range, $matches);
        $minValue = floatval($matches[1]);
        $maxValue = floatval($matches[2]);

        if ($minValue >= $maxValue) {
            \Log::debug('Range validation failed: min >= max');
            return redirect()->back()
                ->withErrors(['destination_range' => 'The minimum value must be less than the maximum value in the range'])
                ->withInput();
        }

        // Format the is_enabled field
        $request->merge(['is_enabled' => $request->has('is_enabled') ? true : false]);

        try {
            // Ensure is_enabled is a boolean
            $data = $request->all();
            $data['is_enabled'] = filter_var($data['is_enabled'], FILTER_VALIDATE_BOOLEAN);
            
            // Create the destination
            $destination = Destination::create($data);
            \Log::debug('Destination created successfully:', ['id' => $destination->id]);
            
            return redirect()->route('screen.destination.destinations')
                ->with('success', 'Destination created successfully!');
        } catch (\Exception $e) {
            \Log::error('Failed to create destination:', ['error' => $e->getMessage()]);
            return redirect()->back()
                ->with('error', 'Failed to create destination: ' . $e->getMessage())
                ->withInput();
        }
    }

    /**
     * Display the specified destination.
     */
    public function show(Destination $destination)
    {
        return view('screen.destination.showdestination', compact('destination'));
    }

    /**
     * Show the form for editing the specified destination.
     */
    public function edit(Destination $destination)
    {
        return view('screen.destination.editdestination', compact('destination'));
    }

    /**
     * Update the specified destination in storage.
     */
    public function update(Request $request, Destination $destination)
    {
        // Validate the request
        $validator = Validator::make($request->all(), [
            'boarding_point' => 'required|string|max:255',
            'destination_point' => 'required|string|max:255',
            'distance' => 'required|numeric|min:0',
            'destination_range' => 'required|string|regex:/^\s*(\d+(?:\.\d+)?)\s*-\s*(\d+(?:\.\d+)?)\s*$/',
            'commission_alto' => 'required|numeric|min:0',
            'commission_sedan' => 'required|numeric|min:0',
            'commission_ertiga' => 'required|numeric|min:0',
            'total_fare_alto' => 'required|numeric|min:0',
            'total_fare_sedan' => 'required|numeric|min:0',
            'total_fare_ertiga' => 'required|numeric|min:0',
            'min_booking_alto' => 'required|numeric|min:0',
            'min_booking_sedan' => 'required|numeric|min:0',
            'min_booking_ertiga' => 'required|numeric|min:0',
            'driver_fare_alto' => 'required|numeric|min:0',
            'driver_fare_sedan' => 'required|numeric|min:0',
            'driver_fare_ertiga' => 'required|numeric|min:0',
            'is_enabled' => 'boolean',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        // Extract range values for additional validation
        $rangePattern = '/^\s*(\d+(?:\.\d+)?)\s*-\s*(\d+(?:\.\d+)?)\s*$/';
        preg_match($rangePattern, $request->destination_range, $matches);
        $minValue = floatval($matches[1]);
        $maxValue = floatval($matches[2]);

        if ($minValue >= $maxValue) {
            return redirect()->back()
                ->withErrors(['destination_range' => 'The minimum value must be less than the maximum value in the range'])
                ->withInput();
        }

        // Format the is_enabled field
        $request->merge(['is_enabled' => $request->has('is_enabled') ? true : false]);

        // Update the destination
        $data = $request->all();
        $data['is_enabled'] = filter_var($data['is_enabled'], FILTER_VALIDATE_BOOLEAN);
        $destination->update($data);

        return redirect()->route('screen.destination.destinations')
            ->with('success', 'Destination updated successfully!');
    }

    /**
     * Remove the specified destination from storage.
     */
    public function destroy(Destination $destination)
    {
        $destination->delete();
        
        return redirect()->route('screen.destination.destinations')
            ->with('success', 'Destination deleted successfully!');
    }

    /**
     * Show the form for uploading an Excel file.
     */
    public function showUploadForm()
    {
        return view('screen.destination.uploadexelsheet');
    }

    /**
     * Import destinations from an Excel file.
     */
    public function importExcel(Request $request)
    {
        // Validate the uploaded file
        $validator = Validator::make($request->all(), [
            'excel_file' => 'required|file|mimes:xlsx,xls,csv',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        try {
            // Load the Excel file
            $file = $request->file('excel_file');
            $spreadsheet = IOFactory::load($file->getPathname());
            $worksheet = $spreadsheet->getActiveSheet();
            $rows = $worksheet->toArray();

            // Skip the header row
            $data = array_slice($rows, 1);
            
            // Process each row
            $insertedCount = 0;
            foreach ($data as $row) {
                // Skip empty rows
                if (empty($row[0]) || count(array_filter($row)) < 5) {
                    continue;
                }

                // Map columns to destination fields
                $destinationData = [
                    'boarding_point' => $row[0],
                    'destination_point' => $row[1],
                    'distance' => (float) $row[2],
                    'destination_range' => $row[3],
                    'commission_alto' => (float) $row[4],
                    'commission_sedan' => (float) $row[5],
                    'commission_ertiga' => (float) $row[6],
                    'total_fare_alto' => (float) $row[7],
                    'total_fare_sedan' => (float) $row[8],
                    'total_fare_ertiga' => (float) $row[9],
                    'min_booking_alto' => (float) $row[10],
                    'min_booking_sedan' => (float) $row[11],
                    'min_booking_ertiga' => (float) $row[12],
                    'driver_fare_alto' => (float) $row[13],
                    'driver_fare_sedan' => (float) $row[14],
                    'driver_fare_ertiga' => (float) $row[15],
                    'is_enabled' => isset($row[16]) ? filter_var($row[16], FILTER_VALIDATE_BOOLEAN) : true,
                ];

                // Validate the destination range
                $rangePattern = '/^\s*(\d+(?:\.\d+)?)\s*-\s*(\d+(?:\.\d+)?)\s*$/';
                if (!preg_match($rangePattern, $destinationData['destination_range'], $matches)) {
                    continue; // Skip invalid range format
                }

                // Create the destination
                Destination::create($destinationData);
                $insertedCount++;
            }

            return redirect()->route('screen.destination.destinations')
                ->with('success', "$insertedCount destinations imported successfully!");

        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Error importing destinations: ' . $e->getMessage());
        }
    }

    /**
     * Generate and download a sample Excel file for destinations.
     */
    public function downloadSampleExcel()
    {
        $spreadsheet = new \PhpOffice\PhpSpreadsheet\Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        
        // Set headers
        $headers = [
            'Boarding Point', 'Destination Point', 'Distance', 'Destination Range',
            'Commission SEDAN', 'Commission ERTIGA', 'Commission CRYSTA',
            'Total Fare SEDAN', 'Total Fare ERTIGA', 'Total Fare CRYSTA',
            'Min Booking SEDAN', 'Min Booking ERTIGA', 'Min Booking CRYSTA',
            'Driver Fare SEDAN', 'Driver Fare ERTIGA', 'Driver Fare CRYSTA',
            'Is Enabled'
        ];
        
        // Use setCellValue with column letters instead
        $columns = ['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q'];
        foreach ($headers as $key => $header) {
            $sheet->setCellValue($columns[$key] . '1', $header);
        }
        
        // Add sample data
        $sampleData = [
            ['City A', 'City B', 150, '120 - 180', 50, 80, 100, 500, 700, 900, 200, 300, 400, 300, 400, 500, 1],
            ['City C', 'City D', 200, '180 - 220', 60, 90, 120, 600, 800, 1000, 250, 350, 450, 350, 450, 550, 1]
        ];
        
        $row = 2;
        foreach ($sampleData as $data) {
            foreach ($data as $key => $value) {
                $sheet->setCellValue($columns[$key] . $row, $value);
            }
            $row++;
        }
        
        // Auto-size columns
        foreach ($columns as $col) {
            $sheet->getColumnDimension($col)->setAutoSize(true);
        }
        
        // Style the header row
        $headerStyle = [
            'font' => [
                'bold' => true,
                'color' => ['rgb' => 'FFFFFF'],
            ],
            'fill' => [
                'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                'startColor' => ['rgb' => '4472C4'],
            ]
        ];
        
        $sheet->getStyle('A1:Q1')->applyFromArray($headerStyle);
        
        // Create writer and set up response
        $writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet);
        $fileName = 'destination_sample.xlsx';
        
        // Create a temporary file
        $tempFile = tempnam(sys_get_temp_dir(), 'excel');
        $writer->save($tempFile);
        
        // Return file as a download
        return response()->download($tempFile, $fileName)->deleteFileAfterSend(true);
    }
} 