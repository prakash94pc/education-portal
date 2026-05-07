 <?php
header('Content-Type: application/json');

$data = json_decode(file_get_contents('php://input'), true);
$userMessage = strtolower($data['message']);

// Smart AI Responses
$responses = [
    'hello' => 'Hello! Welcome to Shikhar Shiksha. How can I assist you today?',
    'hi' => 'Hi there! 👋 Need help with courses, pricing, or something else?',
    'courses' => 'We offer courses in Web Development, Data Science, AI/ML, Mobile Development, Cloud Computing, and Digital Marketing!',
    'price' => 'Our courses range from ₹799 to ₹1999. We also offer discounts and EMI options!',
    'web development' => 'Our Full Stack Web Dev course covers HTML, CSS, JS, React, Node.js, MongoDB. Price: ₹999 only!',
    'data science' => 'Data Science Pro includes Python, Pandas, Machine Learning, Tableau, SQL. Just ₹1499!',
    'ai' => 'AI & ML course covers Deep Learning, NLP, Computer Vision, TensorFlow. Price: ₹1999',
    'duration' => 'Most courses are 2-6 months long with lifetime access to recordings!',
    'certificate' => 'Yes! You get a government recognized certificate after completing any course.',
    'payment' => 'We accept UPI, Credit/Debit Cards, Net Banking, and EMI options.',
    'support' => '24/7 support available! Call us at 1800-123-456 or email support@shikhar.com',
    'discount' => 'Currently we have 50% off on all courses! Use code: SHIKHAR50',
    'enroll' => 'To enroll, just sign up and click Enroll button on any course page!',
    'thank' => 'You\'re welcome! 😊 Anything else I can help with?',
    'bye' => 'Goodbye! Feel free to come back if you have more questions! 👋'
];

$response = "I'm here to help! You can ask me about courses, pricing, duration, certificates, payment methods, or discounts.";

foreach($responses as $key => $reply) {
    if(strpos($userMessage, $key) !== false) {
        $response = $reply;
        break;
    }
}

echo json_encode(['response' => $response]);
?>