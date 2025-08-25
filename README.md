# IP Address Lookup Tool

A simple, lightweight web application that provides detailed information about IP addresses using the ip-api.com service. This tool allows users to enter any IP address and retrieve geolocation and ISP information in real-time.

## Features

- **Real-time IP lookup**: Get instant information about any IP address
- **Geolocation data**: Country, region, and city information
- **ISP information**: Internet Service Provider details
- **Clean interface**: Simple and user-friendly design
- **Input validation**: Server-side IP address validation
- **Error handling**: Graceful error messages for invalid inputs

## Demo

Enter any valid IP address (e.g., `8.8.8.8`, `1.1.1.1`) to see:
- Country
- Region/State
- City
- Internet Service Provider (ISP)

## Technologies Used

- **Frontend**: HTML5, CSS3, JavaScript
- **Backend**: PHP
- **JavaScript Library**: jQuery 3.7.1
- **API**: [ip-api.com](http://ip-api.com/) (free tier)
- **HTTP Client**: cURL (PHP)

## Project Structure

```
ip-lookup/
├── index.html              # Main HTML page
├── script.js               # Frontend JavaScript logic
├── iplookup.php            # Backend PHP API handler
├── jquery-3.7.1.min.js     # jQuery library
├── LICENSE                 # MIT License
└── README.md               # This file
```

## Installation & Setup

### Prerequisites

- Web server with PHP support (Apache, Nginx, etc.)
- PHP 7.0 or higher
- cURL extension enabled in PHP

### Local Setup

1. **Clone or download** this repository:
   ```bash
   git clone https://github.com/naimz82/ip-lookup.git
   ```

2. **Place files** in your web server directory:
   ```bash
   # For Apache (Linux)
   sudo cp -r ip-lookup/ /var/www/html/
   
   # For XAMPP (Windows/Mac)
   cp -r ip-lookup/ /Applications/XAMPP/htdocs/  # Mac
   cp -r ip-lookup/ C:\xampp\htdocs\            # Windows
   ```

3. **Ensure PHP cURL is enabled**:
   ```bash
   # Check if cURL is enabled
   php -m | grep curl
   ```

4. **Access the application**:
   Open your web browser and navigate to:
   ```
   http://localhost/ip-lookup/
   ```

## How It Works

### Frontend (index.html + script.js)

1. User enters an IP address in the input field
2. Form submission is intercepted by JavaScript
3. AJAX request is sent to `iplookup.php` with the IP address
4. Response is displayed in the `#IpInfo` div

### Backend (iplookup.php)

1. Receives POST request with IP address
2. Validates the IP address using PHP's `filter_var()`
3. Makes API call to `ip-api.com` using cURL
4. Processes the JSON response
5. Returns formatted data or error message

### API Integration

This project uses the free tier of [ip-api.com](http://ip-api.com/) which provides:
- 1,000 requests per month
- No API key required
- JSON response format
- Geolocation and ISP data

## Code Examples

### JavaScript AJAX Request
```javascript
$("#formIpLookup").on("submit", function(e){
    e.preventDefault();
    let iplookaddr = $("#iplookaddr").val();
    $.ajax({
        url: "iplookup.php",
        method: "POST",
        data: { iplookaddr: iplookaddr },
        dataType: "json",
        success: function (response) {
            if (response.status === "success") {
                $("#IpInfo").html(response.msg);
            } else {
                $("#IpInfo").html("<em>No information found.</em>");
            }
        }
    });
});
```

### PHP API Handler
```php
<?php
$clientIp = $_POST["iplookaddr"];
filter_var($clientIp, FILTER_VALIDATE_IP) or die(json_encode(["status"=>"fail","msg"=>"Invalid IP address."]));

$url = "http://ip-api.com/json/".$clientIp;
$curl = curl_init($url);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
$result = curl_exec($curl);
curl_close($curl);

$obj = json_decode($result);
// Process and return data...
?>
```

## Customization

### Adding More Data Fields

You can extend the application to show additional information by modifying `iplookup.php`:

```php
$timezone = $obj->timezone ?? "unknown";
$lat = $obj->lat ?? "unknown";
$lon = $obj->lon ?? "unknown";

$msg .= "<strong>Timezone:</strong> ".$timezone."<br>";
$msg .= "<strong>Coordinates:</strong> ".$lat.", ".$lon."<br>";
```

### Styling

Add your own CSS styles to `index.html` or create a separate CSS file for custom styling.

### Error Handling

The application includes basic error handling, but you can enhance it further:
- Rate limiting
- Input sanitization
- Logging
- User feedback improvements

## Security Considerations

- **Input Validation**: The application validates IP addresses on the server side
- **API Limits**: Be aware of the 1,000 requests/month limit on the free tier
- **HTTPS**: Consider using HTTPS in production
- **Rate Limiting**: Implement rate limiting to prevent abuse

## Limitations

- Uses free tier of ip-api.com (1,000 requests/month)
- No rate limiting implemented
- Basic error handling
- No caching mechanism

## Contributing

1. Fork the repository
2. Create a feature branch: `git checkout -b feature-name`
3. Commit your changes: `git commit -m 'Add some feature'`
4. Push to the branch: `git push origin feature-name`
5. Submit a pull request

## License

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details.

## Acknowledgments

- [ip-api.com](http://ip-api.com/) for providing the free IP geolocation API
- [jQuery](https://jquery.com/) for JavaScript functionality

## Author

**AMZ IT Solutions**
- GitHub: [@naimz82](https://github.com/naimz82)

---

*Feel free to use this code for learning purposes or to integrate into your own projects!*
