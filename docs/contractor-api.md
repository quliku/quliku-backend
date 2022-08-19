# Contractor API List

## Authentication

### 1. Register

- URL: `/api/contractor/auth/register`
- Method: `POST`
- Request body:
  - `name`: string
  - `username`: string
  - `email`: string
  - `password`: string
  - `password_confirmation`: string
  - `profile_image`: file (opsional)

**Example success response**
```json
{
    "success": true,
    "message": "success",
    "data": {
        "id": 31,
        "name": "Richard Asmarakandi",
        "username": "richard",
        "email": "richard@gmail.com",
        "role": "contractor",
        "profile_url": "http://127.0.0.1:8000/images/user-default.png"
    }
}
```
**Example validation error response**
```json
{
    "success": false,
    "message": "Validation Error",
    "data": {
        "username": [
            "The username has already been taken."
        ],
        "email": [
            "The email has already been taken."
        ]
    }
}
```

### 2. Login

- URL: `/api/contractor/auth/login`
- Method: `POST`
- Request body:
  - `email`: string, email or username
  - `password`: string

**Example success response**
```json
{
    "success": true,
    "message": "success",
    "data": {
        "id": 2,
        "name": "M. Auliya Mirzaq Romdloni",
        "username": "mirzaq19",
        "email": "mirzaqarjap@gmail.com",
        "role": "contractor",
        "profile_url": "https://quliku.com/storage/profile_images/mirzaq19.jpg",
        "token": "2|rhUBav6dI0nwN1nbDzx9VOhys6NdRXFIQMN2ERrp"
    }
}
```
**Example invalid credential error response**
```json
{
    "success": false,
    "message": "1000:Invalid credentials",
    "data": {
        "message": "Invalid credentials",
        "code": 1000
    }
}
```

### 3. Get user data

- URL: `/api/contractor/auth/me`
- Method: `GET`
- Headers:
  - Authorization: Bearer **{token}**

**Example success response**
```json
{
    "success": true,
    "message": "success",
    "data": {
        "id": 2,
        "name": "M. Auliya Mirzaq Romdloni",
        "username": "mirzaq19",
        "email": "mirzaqarjap@gmail.com",
        "role": "contractor",
        "profile_url": "https://quliku.com/storage/profile_images/mirzaq19.jpg"
    }
}
```

### 4. Update user data

- URL: `/api/contractor/auth/update`
- Method: `POST`
- Headers:
  - Authorization: Bearer **{token}**
- Request body:
  - `name`: string
  - `email`: string
  - `password`: string (opsional)
  - `password_confirmation`: string (opsional)
  - `profile_image`: file (opsional)

**Example success response**
```json
{
    "success": true,
    "message": "success",
    "data": {
        "id": 2,
        "name": "M. Auliya Mirzaq",
        "username": "mirzaq19",
        "email": "mirzaqarjap@gmail.com",
        "role": "contractor",
        "profile_url": "https://quliku.com/storage/profile_images/mirzaq19.jpg"
    }
}
```
**Example validation error response**
```json
{
    "success": false,
    "message": "Validation Error",
    "data": {
        "email": [
            "The email field is required."
        ]
    }
}
```

### 5. Logout

- URL: `/api/contractor/auth/logout`
- Method: `POST`
- Headers:
  - Authorization: Bearer **{token}**

**Example success response**
```json
{
    "success": true,
    "message": "success"
}
```

## Foreman

### 1. Search foreman

- URL: `/api/contractor/foreman/search`
- Method: `GET`
- Parameters:
  - `name`: string
  - `classification`: string [`water` | `craft` | `infra`] (opsional)
  - `city`: string (opsional)

**Example success response**
```json
{
    "success": true,
    "message": "success",
    "data": [
        {
            "id": 33,
            "name": "Budi Purwanto",
            "username": "budi.purwa",
            "email": "budi@gmail.com",
            "role": "foreman",
            "profile_url": "http://127.0.0.1:8000/images/user-default.png",
            "rating": 4,
            "details": {
                "subscription": "regular",
                "is_work": 0,
                "city": "Mojokerto",
                "wa_number": "082234260055",
                "classification": "craft",
                "description": "Saya berpengalaman dalam hiasan eksterior maupun interior bangunan",
                "experience": 12,
                "min_people": 40,
                "max_people": 70,
                "price": "1200000.00"
            }
        }
    ]
}
```

### 2. Recommendation foreman

- URL: `/api/contractor/foreman/recommendation`
- Method: `GET`

**Example success response**
```json
{
    "success": true,
    "message": "success",
    "data": [
        {
            "id": 33,
            "name": "Budi Purwanto",
            "username": "budi.purwa",
            "email": "budi@gmail.com",
            "role": "foreman",
            "profile_url": "http://127.0.0.1:8000/images/user-default.png",
            "rating": 4,
            "details": {
                "subscription": "regular",
                "is_work": 0,
                "city": "Mojokerto",
                "wa_number": "082234260055",
                "classification": "craft",
                "description": "Saya berpengalaman dalam hiasan eksterior maupun interior bangunan",
                "experience": 12,
                "min_people": 40,
                "max_people": 70,
                "price": "1200000.00"
            }
        },
        "..."
    ]
}
```

### 3. Detail foreman

- URL: `/api/contractor/foreman/detail/{id}`
- Method: `GET`
- Headers:
  - Authorization: Bearer **{token}**

**Example success response**
```json
{
    "success": true,
    "message": "success",
    "data": {
        "id": 33,
        "name": "Budi Purwanto",
        "username": "budi.purwa",
        "email": "budi@gmail.com",
        "role": "foreman",
        "profile_url": "http://127.0.0.1:8000/images/user-default.png",
        "rating": 4,
        "details": {
            "subscription": "regular",
            "is_work": 0,
            "city": "Mojokerto",
            "wa_number": "082234260055",
            "classification": "craft",
            "description": "Saya berpengalaman dalam hiasan eksterior maupun interior bangunan",
            "experience": 12,
            "min_people": 40,
            "max_people": 70,
            "price": "1200000.00",
            "bank_type": "BRI",
            "account_name": "Budi Purwanto",
            "account_number": "0385562987452"
        },
        "images": [
            {
                "photo_url": "http://127.0.0.1:8000/storage/foreman_images/budi.purwa-1660385897517.jpg",
                "type": "ktp"
            },
            {
                "photo_url": "http://127.0.0.1:8000/storage/foreman_images/budi.purwa-1660385897676.jpg",
                "type": "certificate"
            },
            {
                "photo_url": "http://127.0.0.1:8000/storage/foreman_images/budi.purwa-1660385897690.jpg",
                "type": "portfolio"
            }
        ],
        "comments": [
            {
                "name": "M. Auliya Mirzaq Romdloni",
                "rating": 4,
                "description": "Hasil jadinya sangat memuaskan"
            }
        ],
        "in_wishlist": false
    }
}
```
**Example not found error response**
```json
{
    "success": false,
    "message": "1004:Foreman not found",
    "data": {
        "message": "Foreman not found",
        "code": 1004
    }
}
```

### 4. Wishlist foreman

- URL: `/api/contractor/foreman/wishlist`
- Method: `GET`
- Headers:
    - Authorization: Bearer **{token}**
- Parameters:
    - `classification`: string [`water` | `craft` | `infra`] (opsional)
    - `city`: string (opsional)

**Example success response**
```json
{
    "success": true,
    "message": "success",
    "data": [
        {
            "id": 33,
            "name": "Budi Purwanto",
            "username": "budi.purwa",
            "email": "budi@gmail.com",
            "role": "foreman",
            "profile_url": "http://127.0.0.1:8000/images/user-default.png",
            "rating": 4,
            "details": {
                "subscription": "regular",
                "is_work": 0,
                "city": "Mojokerto",
                "wa_number": "082234260055",
                "classification": "craft",
                "description": "Saya berpengalaman dalam hiasan eksterior maupun interior bangunan",
                "experience": 12,
                "min_people": 40,
                "max_people": 70,
                "price": "1200000.00",
                "bank_type": "BRI",
                "account_name": "Budi Purwanto",
                "account_number": "0385562987452"
            },
            "comments": [
                {
                    "name": "M. Auliya Mirzaq Romdloni",
                    "rating": 4,
                    "description": "Hasil jadinya sangat memuaskan"
                }
            ]
        }
    ]
}
```

### 5. Add foreman to wishlist 

- URL: `/api/contractor/foreman/wishlist`
- Method: `POST`
- Headers:
    - Authorization: Bearer **{token}**
- Request body:
    - `foreman_id`: integer

**Example success response**
```json
{
    "success": true,
    "message": "success"
}
```

### 6. Remove foreman to wishlist

- URL: `/api/contractor/foreman/wishlist`
- Method: `DELETE`
- Headers:
    - Authorization: Bearer **{token}**
- Request body:
    - `foreman_id`: integer

**Example success response**
```json
{
    "success": true,
    "message": "success"
}
```