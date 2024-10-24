import hashlib
import os

def create_wallet():
    private_key = os.urandom(32).hex()
    public_key = hashlib.sha256(private_key.encode()).hexdigest()
    wallet_address = hashlib.sha256(public_key.encode()).hexdigest()
    return private_key, public_key, wallet_address
