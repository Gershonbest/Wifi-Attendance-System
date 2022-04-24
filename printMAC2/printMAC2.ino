#include <ESP8266WiFi.h>
#include <ESP8266WiFi.h>
#include <WiFiClient.h>
#include <ESP8266WebServer.h> 
#include <ESP8266HTTPClient.h>
#include <ESP8266HttpClient.h>

#include <DNSServer.h>
const byte DNS_PORT = 53;
extern "C" {
  #include<user_interface.h>
}
#define HOST "http://mywifiattendance.atwebpages.com"
/* configuration  wifi */
//IPAddress apIP(172, 217, 28, 1);
IPAddress apIP(192, 168, 4, 1);
//IPAddress (212,175,35,110) //Updated on 28-01-2022
DNSServer dnsServer;

//const int NO_OF_STUDENTS=51;
String postData;
//String Course_id = "AIE 510";
String course_id = "AIE 580";
//String Room_id = "Amfi 201";
String room_id = "H-16";
String std_mac_adr;

#define WIFI_SSID "LORDS"     //#define WIFI_SSID "RESIDANCE"  
#define WIFI_PASS "glory1234"   //#define WIFI_PASS "M0795603341" 
#define AP_SSID "Attendance"
#define AP_PASS "12345678"

ESP8266WebServer server(80); //Server on port 80

void setup() {
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
}

void loop() {
  delay(1000);
   unsigned char number_client;
  struct station_info *stat_info;
  
  struct ip_addr *IPaddress;
  IPAddress address;
  int i=1;
  
  number_client= wifi_softap_get_station_num();
  stat_info = wifi_softap_get_station_info();
  
  Serial.println(" Total Connected Clients are = ");
  Serial.println(number_client);

      while (stat_info != NULL) {
    
      
      Serial.print("client= ");
      
      Serial.print(i);
     
      Serial.print(" with MAC adress is = ");


     
      
      std_mac_adr.concat(String(stat_info->bssid[0],HEX));
      std_mac_adr.concat(String(stat_info->bssid[1],HEX));
      std_mac_adr.concat(String(stat_info->bssid[2],HEX));
      std_mac_adr.concat(String(stat_info->bssid[3],HEX));
      std_mac_adr.concat(String(stat_info->bssid[4],HEX));
      std_mac_adr.concat(String(stat_info->bssid[5],HEX));

      std_mac_adr.toUpperCase();
      Serial.print(std_mac_adr);
      //delay(4000);
      WiFiClient client;
  HTTPClient http;    // http object of clas HTTPClient
  ESP8266WebServer server(80); //Server on port 80
    
    // Convert integer variables to string
    course_id = (String)course_id;  
    room_id = (String)room_id;   
    std_mac_adr = (String)std_mac_adr;
    
     
    postData = "std_mac_adr=" + std_mac_adr + "&course_id=" + course_id + "&room_id=" + room_id;
    
    // We can post values to PHP files as  example.com/dbwrite.php?name1=val1&name2=val2&name3=val3
    // Hence created variable postDAta and stored our variables in it in desired format
    // For more detials, refer:- https://www.tutorialspoint.com/php/php_get_post.html
    
    // Update Host URL here:-  
    http.begin(client,"http://mywifiattendance.atwebpages.com/apiwrite.php");  
   // http.begin(client,"http://app.neu.edu.tr:9001/dbwrite.php");
    
    http.addHeader("Content-Type", "application/x-www-form-urlencoded");            //Specify content-type header
    
      
     
    int httpCode = http.POST(postData);   // Send POST request to php file and store server response code in variable named httpCode
    Serial.println("Values are, Course = " + course_id + " Room Number = "+room_id+ " and MAC Address = "+std_mac_adr);
    
    
    // if connection eatablished then do this
    if (httpCode == 200) { Serial.println("Values uploaded successfully."); 
    Serial.println(httpCode); 
    }
    
    // if failed to connect then return and restart
    
    else { 
      Serial.println(httpCode); 
      Serial.println("Failed to upload values. \n"); 
      http.end(); 
       }
     delay(2000);
      std_mac_adr.remove(0,100);
      
      stat_info = STAILQ_NEXT(stat_info, next);

      
      i++;
      Serial.println();
      }


    
  delay(500);
}

//boolean upload_data(String std_mac_adr, String course_id, String room_id){
//  
//  }
