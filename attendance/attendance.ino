#include <ESP8266WiFi.h>
#include <WiFiClient.h>
#include <ESP8266WebServer.h> 
#include <ESP8266HTTPClient.h>
#include <ESP8266HttpClient.h>
//#include <SerialResponse.h>
#include <DNSServer.h>
const byte DNS_PORT = 53;
//IPAddress apIP(172, 217, 28, 1);
IPAddress apIP(192, 168, 4, 1);
//IPAddress (212,175,35,110) //Updated on 28-01-2022
DNSServer dnsServer;
//#define HOST "lobate-complements.000webhostapp.com"
//#define HOST "20214000.000webhostapp.com"          // Enter HOST URL without "http:// "  and "/" at the end of URL
#define HOST "http://mywifiattendance.atwebpages.com"
//#define HOST "http://app.neu.edu.tr:9001" //Updated on 28-01-2022
String postData;
//String Course_id = "AIE 510";
String Course_id = "AIE 580";
//String Room_id = "Amfi 201";
String Room_id = "H-16";
const char MAIN_page[] PROGMEM = R"=====(
<!DOCTYPE html>
<html>
<head>
     <style>
          .gradient-custom-3 {
          text-align: center;
          /* fallback for old browsers */
          background: #FFFFFF;

          background: linear-gradient(to right, rgba(132, 250, 176, 0.5), rgba(143, 211, 244, 0.5))
          }
          .gradient-custom-4 {
          /* fallback for old browsers */
          background: #FFFFFF;
          text-align: center;

}
       h1 {
       color: #781614;
       text-align: center;
       font-family: verdana;
       font-size: 60px;
}
       h2 {
       color: #781614;
       text-align: center;
       font-family: verdana;
       font-size: 40px;
}
       h3 {
       color: #E97451;
       text-align: center;
       font-family: serif;
       font-size: 30px;
}
input[type=submit] {
  background-color: #E97451;
  border: none;
  border-radius: 20px;
  border: 2px solid #781614;
  color: black;
  padding: 16px 32px;
  font-size: 16px;
  text-decoration: none;
  margin: 4px 2px;
  cursor: pointer;
}
        input[type=number] {
  width:70%;
  height:5%
  background-color: #FFFFFF;
  background-position: 20px 20px;
  height: 40px;
  background-repeat: no-repeat;
  padding-left: 40px;
  border: 2px solid #b01919;
  border-radius: 4px;
  font-size: 16px;
}
     </style>
</head>


<body background="#FFFFFF">


<form action="/action_page">
 <section class="vh-100 bg-image" style="background-image: #FFFFFF">
  <div class="mask d-flex align-items-center h-100 gradient-custom-3">
    <div class="container h-100">
      <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col-12 col-md-9 col-lg-7 col-xl-6">
          <div class="card" style="border-radius: 29px;">
            <div class="card-body p-5" >
              <h1 class="text-uppercase text-center mb-5">NEU RESEARCH CENTER FOR A.I & IOT</h1>
              <h1 class="text-uppercase text-center mb-5">A.I & ROBOTICS INSTITUE</h1>
              
              <br><br>
              <h2 class="text-uppercase text-center mb-5">WiFi Attendance System</h2>
              <h3 class="text-uppercase text-center mb-5">Enter your ID to mark Attendance</h3>

              <form>
                  
              
                <div class="d-flex justify-content-center" style="justify-content: right;">

                  <input type="number" id="form3Example4cg" class="form-control form-control-lg" placeholder="Enter your ID" name="stdno" required type="number"/>
                  
                </div><br><br>

                <div class="d-flex justify-content-center">
                  <input type="submit" value="Submit">
                </div>

               

              </form>

            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

</body>
</html>
)=====";

const char Confirm_page[] PROGMEM = R"=====(
<!DOCTYPE html>
<html>
<head>
     <style>
          .gradient-custom-3 {
          text-align: center;
          /* fallback for old browsers */
          background: #FFFFFF;
//
//          /* Chrome 10-25, Safari 5.1-6 */
//          background: -webkit-linear-gradient(to right, rgba(222, 250, 176, 0.5), rgba(143, 211, 244, 0.5));
//
//          /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
//          background: linear-gradient(to right, rgba(132, 250, 176, 0.5), rgba(143, 211, 244, 0.5))
          }
          .gradient-custom-4 {
          /* fallback for old browsers */
          background: #FFFFFF;
          text-align: center;

//          /* Chrome 10-25, Safari 5.1-6 */
//          background: -webkit-linear-gradient(to right, rgba(222, 250, 176, 1), rgba(143, 211, 244, 1));
//
//          /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
//         background: linear-gradient(to right, rgba(177, 18, 38, 0.5), rgba(197, 211, 244, 1))

}
       h1 {
       color: #781614;
       text-align: center;
       font-family: verdana;
       font-size: 60px;
}
       h2 {
       color: #781614;
       text-align: center;
       font-family: verdana;
       font-size: 40px;
}
       h3 {
       color: #E97451;
       text-align: center;
       font-family: serif;
       font-size: 30px;
}
input[type=submit] {
  background-color: #b01919;
  border: none;
  border-radius: 20px;
  border: 2px solid #FB3FDE;
  color: white;
  padding: 16px 32px;
  font-size: 16px;
  text-decoration: none;
  margin: 4px 2px;
  cursor: pointer;
}
        input[type=text] {
  background-color: #f5a37a;
  background-position: 20px 20px;
  height: 40px;
  background-repeat: no-repeat;
  padding-left: 40px;
  border: 2px solid #b01919;
  border-radius: 4px;
  font-size: 16px;
}
     </style>
</head>


<body background="#33475b">
 <section class="vh-100 bg-image" style="background-image: #33475b">
  <div class="mask d-flex align-items-center h-100 gradient-custom-3">
    <div class="container h-100">
      <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col-12 col-md-9 col-lg-7 col-xl-6">
          <div class="card" style="border-radius: 29px;">
            <div class="card-body p-5" >
              <h1 class="text-uppercase text-center mb-5">NEU RESEARCH CENTER FOR A.I & IOT</h1>
              <h2 class="text-uppercase text-center mb-5">A.I & ROBOTICS INSTITUE</h2>
              <h3 class="text-uppercase text-center mb-5">Attendance Successful !!!</h3>

              <h3 class="text-uppercase text-center mb-5">Enter your ID again to leave class</h3>

              <form>
                  
              
                <div class="d-flex justify-content-center" style="justify-content: right;">

                  <input type="number" id="form3Example4cg" class="form-control form-control-lg" placeholder="Enter your ID" name="stdno" required type="number"/>
                  
                </div><br><br>

                <div class="d-flex justify-content-center">
                  <input type="submit" value="Submit">
                </div>

            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

</body>
)=====";


boolean upload_data(String stdno, String course_id, String room_id){
  WiFiClient client;
  HTTPClient http;    // http object of clas HTTPClient
  ESP8266WebServer server(80); //Server on port 80
    
    // Convert integer variables to string
    course_id = (String)course_id;  
    room_id = (String)room_id;   
    stdno = (String)stdno;
    
     
    postData = "stdno=" + stdno + "&course_id=" + course_id + "&room_id=" + room_id;
    
    // We can post values to PHP files as  example.com/dbwrite.php?name1=val1&name2=val2&name3=val3
    // Hence created variable postDAta and stored our variables in it in desired format
    // For more detials, refer:- https://www.tutorialspoint.com/php/php_get_post.html
    
    // Update Host URL here:-  
    http.begin(client,"http://mywifiattendance.atwebpages.com/apiwrite.php");  
   // http.begin(client,"http://app.neu.edu.tr:9001/dbwrite.php");
    
    http.addHeader("Content-Type", "application/x-www-form-urlencoded");            //Specify content-type header
    
      
     
    int httpCode = http.POST(postData);   // Send POST request to php file and store server response code in variable named httpCode
    Serial.println("Values are, Course = " + course_id + " Room Number = "+room_id+ " and Student no = "+stdno);
    
    
    // if connection eatablished then do this
    if (httpCode == 200) { Serial.println("Values uploaded successfully."); 
    Serial.println(httpCode); 

//    String webpage = http.getString();    // Get html webpage output and store it in a string
//    Serial.println(webpage + "\n");
//    delay(500); 
    }
    
    // if failed to connect then return and restart
    
    else { 
      Serial.println(httpCode); 
      Serial.println("Failed to upload values. \n"); 
      http.end(); 
       }

  }
// Set WiFi credentials
//#define WIFI_SSID "BIGMOO"
#define WIFI_SSID "LORDS"     //#define WIFI_SSID "RESIDANCE"  
#define WIFI_PASS "glory1234"   //#define WIFI_PASS "M0795603341" 
//#define WIFI_SSID "NEU STUDENT"
// Set AP credentials
#define AP_SSID "H-16"
#define AP_PASS "12345678"

ESP8266WebServer server(80); //Server on port 80

//===============================================================
// This routine is executed when you open its IP in browser
//===============================================================
void handleRoot() {
 String s = MAIN_page; //Read HTML contents
 server.send(200, "text/html", s); //Send web page
}
//===============================================================
// This routine is executed when you press submit
//===============================================================
void handleForm() {

 
// String firstName = server.arg("Name"); 
// String lastName = server.arg("Surname");
 String Stdno = server.arg("stdno");

 Serial.print("Student Number:");
 Serial.println(Stdno);

 String c = Confirm_page; //Read HTML contents
 server.send(200, "text/html", c); //Send web page

 upload_data(Stdno, Course_id, Room_id);
 Serial.print("We didnt crash");
// String s = "<a href='/'> Go Back </a>";
// server.send(200, "text/html", s); //Send web page
}

void setup()
{
  // Setup serial port
  Serial.begin(115200);
  Serial.println();
 
  // Begin Access Point
  WiFi.mode(WIFI_AP_STA);
  WiFi.softAPConfig(apIP, apIP, IPAddress(255, 255, 255, 0));
  WiFi.softAP(AP_SSID, AP_PASS);

  // if DNSServer is started with "*" for domain name, it will reply with
  // provided IP to all DNS request
  dnsServer.start(DNS_PORT, "*", apIP);
  
  // Begin WiFi
  //WiFi.begin(WIFI_SSID/*, WIFI_PASS*/);
  WiFi.begin(WIFI_SSID, WIFI_PASS);
 
  // Connecting to WiFi...
  Serial.print("Connecting to ");
  Serial.print(WIFI_SSID);
  while (WiFi.status() != WL_CONNECTED)
  {
    delay(1000);
    Serial.print(".");
  }
 
  // Connected to WiFi
  Serial.println();
  Serial.println("Connected!");
  Serial.print("IP address for network ");
  Serial.print(WIFI_SSID);
  Serial.print(" : ");
  Serial.println(WiFi.localIP());
  Serial.print("IP address for network ");
  Serial.print(AP_SSID);
  Serial.print(" : ");
  Serial.print(WiFi.softAPIP());
  //=========================================================================
  server.on("/", handleRoot);      //Which routine to handle at root location
  server.on("/action_page", handleForm); //form action is handled here
  server.begin();                  //Start server
  Serial.println("HTTP server started");
 //==========================================================================

}

void loop() {
  // put your main code here, to run repeatedly:
  dnsServer.processNextRequest();
    server.onNotFound([]() {
    server.send(200, "text/html", MAIN_page);
  });
  server.handleClient();          //Handle client requests
}
