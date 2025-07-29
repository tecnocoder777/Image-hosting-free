const express = require('express');
const multer = require('multer');
const path = require('path');
const app = express();

const uploadDir = path.join(__dirname, 'uploads');
const storage = multer.diskStorage({
  destination: uploadDir,
  filename: (req, file, cb) => {
    cb(null, Date.now() + "_" + file.originalname);
  }
});
const upload = multer({ storage });

app.use('/uploads', express.static(uploadDir));
app.use(express.static(__dirname)); // serve index.html

app.post('/upload', upload.single('file'), (req, res) => {
  const fileUrl = `/uploads/${req.file.filename}`;
  res.json({ url: fileUrl });
});

module.exports = app;