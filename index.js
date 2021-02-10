const https = require('https');

https.createServer((req, res) => {
    res.write('<h3>Hello world</h3>')
    res.end('Hello world')
}).listen(4000)