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
