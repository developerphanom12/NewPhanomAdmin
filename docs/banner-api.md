# Banner API Documentation

This documentation provides details about the Banner API endpoints available for mobile applications.

## Get Active Banners

Returns a list of all active banners sorted by priority order (lowest priority number first).

### Request

```
GET /api/banners
```

### Response

```json
{
  "success": true,
  "data": [
    {
      "id": 1,
      "title": "Banner 1",
      "image_url": "https://example.com/storage/banners/image1.jpg",
      "priority": 1,
      "link_url": "https://example.com/promo1"
    },
    {
      "id": 2,
      "title": "Banner 2",
      "image_url": "https://example.com/storage/banners/image2.jpg",
      "priority": 2,
      "link_url": "https://example.com/promo2"
    }
  ]
}
```

### Response Fields

| Field       | Type    | Description                                            |
|-------------|---------|--------------------------------------------------------|
| success     | boolean | Indicates if the request was successful                |
| data        | array   | Array of banner objects                                |
| id          | integer | Unique identifier for the banner                       |
| title       | string  | Title of the banner                                    |
| image_url   | string  | Full URL to the banner image                           |
| priority    | integer | Display order priority (lower numbers come first)      |
| link_url    | string  | URL that the banner should link to (can be null)       |

### Error Response

If an error occurs, the API will return:

```json
{
  "success": false,
  "message": "Error message"
}
```

## Implementation Examples

### Android (Kotlin with Retrofit)

```kotlin
// Define the API interface
interface BannerApi {
    @GET("banners")
    suspend fun getActiveBanners(): Response<BannerResponse>
}

// Define the data classes
data class BannerResponse(
    val success: Boolean,
    val data: List<Banner>
)

data class Banner(
    val id: Int,
    val title: String,
    val image_url: String?,
    val priority: Int,
    val link_url: String?
)

// Usage in a ViewModel
class BannerViewModel(private val bannerRepository: BannerRepository) : ViewModel() {
    private val _banners = MutableLiveData<List<Banner>>()
    val banners: LiveData<List<Banner>> = _banners
    
    fun loadBanners() {
        viewModelScope.launch {
            try {
                val response = bannerRepository.getActiveBanners()
                if (response.success) {
                    _banners.value = response.data
                }
            } catch (e: Exception) {
                // Handle error
            }
        }
    }
}
```

### iOS (Swift with URLSession)

```swift
struct Banner: Codable {
    let id: Int
    let title: String
    let imageUrl: String?
    let priority: Int
    let linkUrl: String?
    
    enum CodingKeys: String, CodingKey {
        case id
        case title
        case imageUrl = "image_url"
        case priority
        case linkUrl = "link_url"
    }
}

struct BannerResponse: Codable {
    let success: Bool
    let data: [Banner]
}

class BannerService {
    func fetchBanners(completion: @escaping (Result<[Banner], Error>) -> Void) {
        let url = URL(string: "https://example.com/api/banners")!
        
        URLSession.shared.dataTask(with: url) { data, response, error in
            if let error = error {
                completion(.failure(error))
                return
            }
            
            guard let data = data else {
                completion(.failure(NSError(domain: "No data", code: 0)))
                return
            }
            
            do {
                let bannerResponse = try JSONDecoder().decode(BannerResponse.self, from: data)
                if bannerResponse.success {
                    completion(.success(bannerResponse.data))
                } else {
                    completion(.failure(NSError(domain: "API error", code: 0)))
                }
            } catch {
                completion(.failure(error))
            }
        }.resume()
    }
}
``` 