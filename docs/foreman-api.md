# Foreman API List

## Authentication

### 1. Register

- URL: `/api/foreman/auth/register`
- Method: `POST`
- Request body:
  - `name`: string
  - `username`: string
  - `email`: string
  - `password`: string
  - `password_confirmation`: string
  - `profile_image`: file, max 8MB (opsional)
  - `city`: string,
  - `wa_number`: string
  - `classification`: string [`water` | `infra` | `craft`]
  - `description`: string
  - `experience`: string
  - `min_people`: string
  - `max_people`: string
  - `price`: string
  - `bank_type`: string
  - `account_name`: string
  - `account_number`: string
  - `ktp_image`: file, max size 8MB
  - `certificate_image`: file, max size 8MB (opsional)
  - `portfolio_image`: file, max size 8MB (opsional)

**Example success response**
```json
{
    "success": true,
    "message": "success",
    "data": {
        "id": 34,
        "name": "Prabu Kuncoro",
        "username": "prab.kun",
        "email": "prabu@gmail.com",
        "role": "foreman",
        "profile_url": "http://127.0.0.1:8000/storage/profile_images/prab.kun.png"
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

**Example invalid classification response**
```json
{
    "success": false,
    "message": "1024:Invalid classification",
    "data": {
        "message": "Invalid classification",
        "code": 1024
    }
}
```

### 2. Login

- URL: `/api/foreman/auth/login`
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
        "id": 34,
        "name": "Prabu Kuncoro",
        "username": "prab.kun",
        "email": "prabu@gmail.com",
        "role": "foreman",
        "profile_url": "http://127.0.0.1:8000/storage/profile_images/prab.kun.png",
        "token": "25|TIY4VIyEwU1Vy26eesJq5tr4i73XvYVRti1XtACs"
    }
}
```

**Example invalid credentials response**
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

- URL: `/api/foreman/auth/me`
- Method: `GET`
- Headers:
  - Authorization: Bearer **{token}**

**Example success response**
```json
{
    "success": true,
    "message": "success",
    "data": {
        "id": 34,
        "name": "Prabu Kuncoro",
        "username": "prab.kun",
        "email": "prabu@gmail.com",
        "role": "foreman",
        "profile_url": "http://127.0.0.1:8000/storage/profile_images/prab.kun.png",
        "rating": 0,
        "details": {
            "subscription": "regular",
            "is_work": 0,
            "city": "mojokerto",
            "wa_number": "082234260055",
            "classification": "water",
            "description": "Saya berpengalaman dalam hiasan eksterior maupun interior bangunan",
            "experience": 12,
            "min_people": 40,
            "max_people": 70,
            "price": "1200000.00",
            "bank_type": "BRI",
            "account_name": "Prabu Kuncoro",
            "account_number": "0923743292384"
        },
        "images": [
            {
                "photo_url": "http://127.0.0.1:8000/storage/foreman_images/prab.kun-1660972375523.png",
                "type": "ktp"
            },
            {
                "photo_url": "http://127.0.0.1:8000/storage/foreman_images/prab.kun-1660972375305.png",
                "type": "certificate"
            },
            {
                "photo_url": "http://127.0.0.1:8000/storage/foreman_images/prab.kun-1660972375485.png",
                "type": "portfolio"
            }
        ],
        "comments": []
    }
}
```
