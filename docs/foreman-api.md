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

### 4. Logout

- URL: `/api/foreman/auth/logout`
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

## Project

### 1. Detail project

- URL: `/api/foreman/project/detail/{id}`
- Method: `GET`

**Example success response**
```json
{
    "success": true,
    "message": "success",
    "data": {
        "id": 8,
        "name": "Bangun pager besi",
        "description": "Nambah pager besi depan rumah",
        "status": "review",
        "start_date": "2022-09-25",
        "end_date": "2022-10-24",
        "province": "Jawa Timur",
        "city": "Mojokerto",
        "district": "Sooko",
        "village": "Japan",
        "address": "Perum Japan Raya Jl. Bola Volly A.20",
        "total_price": 7000000,
        "document_url": "https://dashboard.binderbyte.com",
        "fix_people": 3,
        "transportation_fee": 500000,
        "already_paid": null,
        "payment_type": "bulk",
        "wa_number": "087738462285",
        "created_at": "2022-08-13 18:15:32",
        "updated_at": "2022-08-15 18:33:42",
        "rating": {
            "name": "M. Auliya Mirzaq Romdloni",
            "rating": 4,
            "description": "Hasil jadinya sangat memuaskan"
        },
        "reports": [
            {
                "id": 5,
                "user_id": 33,
                "project_id": 8,
                "percentage": 20,
                "description": "Sejauh ini berjalan lancar",
                "images": [
                    "http://127.0.0.1:8000/storage/project/8/report/166039843998.png",
                    "http://127.0.0.1:8000/storage/project/8/report/166039843918.png"
                ]
            },
            {
                "id": 6,
                "user_id": 33,
                "project_id": 8,
                "percentage": 30,
                "description": "Ada beberapa kendala pada batu bata, jadi cukup memakan waktu",
                "images": [
                    "http://127.0.0.1:8000/storage/project/8/report/166039870934.png",
                    "http://127.0.0.1:8000/storage/project/8/report/166039870981.png"
                ]
            },
            {
                "id": 7,
                "user_id": 33,
                "project_id": 8,
                "percentage": 100,
                "description": "Pembangunan sudah selesai",
                "images": [
                    "http://127.0.0.1:8000/storage/project/8/report/166056060220.png"
                ]
            }
        ],
        "payments": [
            {
                "id": 1,
                "user_id": 31,
                "project_id": 8,
                "photo_url": "http://127.0.0.1:8000/storage/project/8/payment/166039054194.jpg",
                "amount": 1000000,
                "status": "verified",
                "description": "Transfer 1000000"
            }
        ],
        "contractor": {
            "id": 31,
            "name": "M. Auliya Mirzaq Romdloni",
            "username": "mirzaq19",
            "email": "mirzaqarjap@gmail.com",
            "role": "contractor",
            "profile_url": "http://127.0.0.1:8000/images/user-default.png"
        },
        "foreman": {
            "id": 33,
            "name": "Budi Purwanto",
            "username": "budi.purwa",
            "email": "budi@gmail.com",
            "role": "foreman",
            "profile_url": "http://127.0.0.1:8000/images/user-default.png"
        }
    }
}
```

**Example not found error response**
```json
{
    "success": false,
    "message": "1003:Project not found",
    "data": {
        "message": "Project not found",
        "code": 1003
    }
}
```

### 2. List project

- URL: `/api/foreman/project/list`
- Method: `GET`
- Headers:
    - Authorization: Bearer **{token}**
- Parameters:
    - `status`: string [ `waiting` | `not_paid` | `ongoing` | `done` | `reject` | `review`] (opsional)

**Example success response**
```json
{
    "success": true,
    "message": "success",
    "data": [
        {
            "id": 8,
            "name": "Bangun pager besi",
            "description": "Nambah pager besi depan rumah",
            "status": "review",
            "start_date": "2022-09-25",
            "end_date": "2022-10-24",
            "province": "Jawa Timur",
            "city": "Mojokerto",
            "district": "Sooko",
            "village": "Japan",
            "address": "Perum Japan Raya Jl. Bola Volly A.20",
            "total_price": 7000000,
            "document_url": "https://dashboard.binderbyte.com",
            "fix_people": 3,
            "transportation_fee": 500000,
            "already_paid": null,
            "payment_type": "bulk",
            "wa_number": "087738462285",
            "created_at": "2022-08-13 18:15:32",
            "updated_at": "2022-08-15 18:33:42",
            "foreman": {
                "id": 33,
                "name": "Budi Purwanto",
                "username": "budi.purwa",
                "email": "budi@gmail.com",
                "role": "foreman",
                "profile_url": "http://127.0.0.1:8000/images/user-default.png"
            }
        }
    ]
}
```
