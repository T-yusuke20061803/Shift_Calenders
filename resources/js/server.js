const express = require('express');
const bodyParser = require('body-parser');
const cors = require('cors');

const app = express();
const port = 3000;

app.use(bodyParser.json());
app.use(cors());

let shifts = [];

// シフトを投稿するエンドポイント
app.post('/shifts', (req, res) => {
    const shift = req.body;
    shifts.push(shift);
    res.status(201).send(shift);
});

// シフトを取得するエンドポイント
app.get('/shifts', (req, res) => {
    res.status(200).send(shifts);
});

app.listen(port, () => {
    console.log(`Server is running on port ${port}`);
});