// server.js
const express = require('express');
const nodemailer = require('nodemailer');
const app = express();
app.use(express.json());
app.use(express.urlencoded({ extended: true }));

app.post('/contact', async (req, res) => {
  const { name, email, message } = req.body;

  let transporter = nodemailer.createTransport({
    service: 'gmail',
    auth: {
      user: process.env.EMAIL_USER,
      pass: process.env.EMAIL_PASS
    }
  });

  await transporter.sendMail({
    from: email,
    to: process.env.EMAIL_USER,
    subject: `New message from ${name}`,
    text: message
  });

  res.send('OK');
});

app.listen(10000, () => console.log('Server running on port 10000'));
