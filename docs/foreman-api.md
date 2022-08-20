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
