const express = require("express");
const multer = require("multer");
const cors = require("cors");
const bodyParser = require("body-parser");
const path = require("path");

const app = express();
app.use(cors());
app.use(bodyParser.json());

const uploadFolder = path.join(__dirname, "../uploads");

// Mock database
let uploadedFiles = [];

// Configure multer for file storage
const storage = multer.diskStorage({
  destination: (req, file, cb) => {
    cb(null, uploadFolder); // Ensure the 'uploads/' folder exists
  },
  filename: (req, file, cb) => {
    cb(null, `${file.originalname}`);
  },
});
const upload = multer({ storage });

// File upload endpoint
app.post("/api/upload", upload.array("file"), (req, res) => {
  if (!req.files || req.files.length === 0) {
    return res.status(400).json({ message: "No files uploaded." });
  }

  // Add file metadata to the "database"
  req.files.forEach((file) => {
    uploadedFiles.push({
      name: file.originalname,
      size: (file.size / 1024).toFixed(2), // Convert bytes to KB
      path: file.path,
    });
  });

  res.status(200).json({ message: "Files uploaded successfully!" });
});

// Fetch uploaded files endpoint
app.get("/api/files", (req, res) => {
  res.status(200).json(uploadedFiles);
});

// Start the server
const PORT = 8080;
app.listen(PORT, () => {
  console.log(`Server running on http://localhost:${PORT}`);
});
