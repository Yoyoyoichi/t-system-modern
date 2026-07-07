const https = require('https');

const url = "https://eqtxzxqvkprnmkiyczvv.supabase.co/rest/v1/a01tsystemrecord01";
const key = "sb_publishable_L9iiPiRICnSt60jLa_xT9A_dgTphJ2e";

const payload = JSON.stringify({
    id: 'terashima01',
    qdate: '2001-01-01',
    correct: 138631,
    incorrect: 92244
});

const options = {
    method: 'POST',
    headers: {
        'apikey': key,
        'Authorization': `Bearer ${key}`,
        'Content-Type': 'application/json',
        'Prefer': 'return=representation'
    }
};

const req = https.request(url, options, (res) => {
    let data = '';
    res.on('data', chunk => data += chunk);
    res.on('end', () => console.log('Response:', data));
});

req.on('error', e => console.error(e));
req.write(payload);
req.end();
