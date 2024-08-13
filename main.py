import random
from fastapi import FastAPI

app = FastAPI()

@app.get("/")
async def root():
    return {
        "id": 1,
        "title": "Hello world",
        "subtitle": "Learn FastAPI",
    }

@app.get("/random/{limit}")
async def get_random(limit: int):
    rn: int = random.randint(1, limit)
    return {
        "random": rn,
        "limit": limit,
    }
