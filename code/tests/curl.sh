#!/usr/bin/env bash
set -euo pipefail

BASE="${BASE_URL:-http://localhost:8000/api}"

auth_body='{"username":"admin","password":"Carlo"}'
auth_response=$(curl -s -X POST "$BASE/auth/login" -H "Content-Type: application/json" -d "$auth_body")
echo "AUTH RAW: $auth_response" >&2
TOKEN=$(printf '%s' "$auth_response" | php -r '$d=json_decode(stream_get_contents(STDIN), true); if(!isset($d["token"])) {fwrite(STDERR, "Auth failed: ".json_encode($d).PHP_EOL); exit(1);} echo $d["token"];')
echo "TOKEN=$TOKEN"

curl -s "$BASE/cars" | jq .

create_response=$(curl -s -X POST "$BASE/cars" \
  -H "Authorization: Bearer $TOKEN" -H "Content-Type: application/json" \
  -d '{"make":"Toyota","model":"Supra","year":2021,"price":55000}')
echo "$create_response" | jq .
CAR_ID=$(printf '%s' "$create_response" | php -r '$d=json_decode(stream_get_contents(STDIN), true); echo $d["id"] ?? "";')
echo "CAR_ID=$CAR_ID"

curl -s "$BASE/cars" | jq .
curl -s "$BASE/cars/$CAR_ID" | jq .

curl -s -X PUT "$BASE/cars/$CAR_ID" \
  -H "Authorization: Bearer $TOKEN" -H "Content-Type: application/json" \
  -d '{"price":54000}' | jq .

curl -s -X POST "$BASE/sales" \
  -H "Authorization: Bearer $TOKEN" -H "Content-Type: application/json" \
  -d "{\"car_id\":$CAR_ID,\"customer_name\":\"Jane Doe\",\"sale_price\":53500}" | jq .

curl -s "$BASE/sales" | jq .

curl -s -X DELETE "$BASE/cars/$CAR_ID" -H "Authorization: Bearer $TOKEN" | jq .
curl -i -s "$BASE/cars/$CAR_ID"
