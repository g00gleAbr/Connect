#include <SPI.h>
#include <Ethernet.h>

//Dirección física
byte mac[] = { 0x90, 0xA2, 0xDA, 0x0D, 0x48, 0xD3 };

//Parametros de la red
IPAddress ip(192,168,1,177);
IPAddress gateway(192,168,1,254);
IPAddress subnet(255, 255, 255, 0);

//Inicializar la librería para el servidor
EthernetServer server(8090);

//Declarar el led de salida
int led1 = 30;
int led2 = 31;
int led3 = 32;
int led4 = 53;
int led5 = 2;
int led6 = 7;
int led7 = 8;

int motor1 = 3;
int motor2 = 5;

int motor3 = 6;
int motor4 = 9;

String readString = String(30);
String statusLed;
String statusMotor;
boolean entrada1=false;
boolean entrada2 = false;
boolean entrada3 = false;
boolean entrada4 = false;

int conta=0;
boolean contador=false;


void setup() {
pinMode(led1, OUTPUT); //Selección del LED
pinMode(led2, OUTPUT);
pinMode(led3, OUTPUT);
pinMode(led4, OUTPUT);
pinMode(led5, OUTPUT);
pinMode(led6, OUTPUT);
pinMode(led7, OUTPUT);

pinMode(motor1, OUTPUT); //Selección de Motores
pinMode(motor2, OUTPUT);

pinMode(motor3, OUTPUT);
pinMode(motor4, OUTPUT);

//Activar muestra de datos en la consola
Serial.begin(9600);
Ethernet.begin(mac,ip,gateway,subnet);
server.begin();
Serial.print("El servidor está en ");
Serial.println(Ethernet.localIP());
}
void loop() {
  delay(10);
  if(contador){
    conta++;
    if(conta>20){
      digitalWrite(motor2, LOW);
      digitalWrite(motor1, LOW);

      digitalWrite(motor4, LOW);
      digitalWrite(motor3, LOW);
      conta=0;
      contador=false;
     }
   }
  EthernetClient client = server.available();
  if(client){
    while(client.connected()){
      if(client.available()){
        char c = client.read();
        
        if(readString.length() < 30){
          readString += (c);
        }
        if(c == '\n'){
          if(readString.indexOf("led1") >= 0) {
            digitalWrite(led1, !digitalRead(led1));
          }
          if(readString.indexOf("led2") >= 0) {
            digitalWrite(led2, !digitalRead(led2));
          }
          if(readString.indexOf("led3") >= 0) {
            digitalWrite(led3, !digitalRead(led3));
          }
          if(readString.indexOf("led4") >= 0) {
            digitalWrite(led4, !digitalRead(led4));
          }
          if(readString.indexOf("led5") >= 0) {
            digitalWrite(led5, !digitalRead(led5));
          }
          if(readString.indexOf("led6") >= 0) {
            digitalWrite(led6, !digitalRead(led6));
          }
          if(readString.indexOf("led7") >= 0) {
            digitalWrite(led7, !digitalRead(led7));
          }
          if(readString.indexOf("motor1") >= 0) {
           entrada1=true;
          }else{
            entrada1=false;
            }
          if(readString.indexOf("motor2") >= 0) {
           entrada2=true;
          }else{
            entrada2=false;
            }

            if(readString.indexOf("motor3") >= 0) {
           entrada3=true;
          }else{
            entrada3=false;
            }
          if(readString.indexOf("motor4") >= 0) {
           entrada4=true;
          }else{
            entrada4=false;
            }
          
          client.println("HTTP/1.1 200 OK");
          client.println("Content-Type: text/html");
          client.println();
         
          client.println("<!doctype html>");
          client.println("<html>");
          client.println("<head>");
          client.println("<title>Pruebas</title>");
          client.println("<meta name=\"viewport\" content=\"width=320\">");
          client.println("<meta name=\"viewport\" content=\"width=device-width\">");
          client.println("<meta charset=\"utf-8\">");
          client.println("<meta name=\"viewport\" content=\"initial-scale=1.0, user-scalable=no\">");
          client.println("<meta http-equiv=\"refresh\" content=\"2.URL=http://192.168.1.177:8090\">");
          client.println("</head>");
          client.println("<body>");
          client.println("<center>");

          if(entrada1){
            statusMotor = "Encendido";
            digitalWrite(motor1, HIGH);
            digitalWrite(motor2, LOW);
            
            entrada1=false;
            entrada2=false;
            contador = true;
          }
          
          client.println("<form action=\"motor1\" method=\"get\">");
          client.println("<button type=submit style=\"width:200px;\">Encender motor 1 </button>");
          client.println("</form> <br />");

          if(entrada2){
            statusMotor = "Encendido";
            digitalWrite(motor2, HIGH);
            digitalWrite(motor1, LOW);
            
            entrada1=false;
            entrada2=false;
            contador=true;
          }

          client.println("<form action=\"motor2\" method=\"get\">");
          client.println("<button type=submit style=\"width:200px;\">Apagar motor 2 </button>");
          client.println("</form> <br />");
          

          if(entrada3){
            statusMotor = "Encendido";
            digitalWrite(motor3, HIGH);
            digitalWrite(motor4, LOW);
            
            entrada3=false;
            entrada4=false;
            contador = true;
          }
          
          client.println("<hr>");
          
          client.println("<form action=\"motor3\" method=\"get\">");
          client.println("<button type=submit style=\"width:200px;\">Encender motor 2 </button>");
          client.println("</form> <br />");

          if(entrada4){
            statusMotor = "Encendido";
            digitalWrite(motor4, HIGH);
            digitalWrite(motor3, LOW);
            
            entrada3 = false;
            entrada4 = false;
            contador = true;
          }

          client.println("<form action=\"motor4\" method=\"get\">");
          client.println("<button type=submit style=\"width:200px;\">Apagar motor 2 </button>");
          client.println("</form> <br />");
          
          if(digitalRead(led1)) {
            statusLed = "Encendido";
            digitalWrite(led1,HIGH);
          } else {
            statusLed = "Apagado";
            digitalWrite(led1,LOW);
          }
          client.println("<form action=\"led1\" method=\"get\">");
          client.println("<button type=submit style=\"width:200px;\">Foco 1 - "+statusLed+"</button>");
          client.println("</form> <br />");
          
          if(digitalRead(led2)) {
            statusLed = "Encendido";
            digitalWrite(led2,HIGH);
          } else {
            statusLed = "Apagado";
            digitalWrite(led2,LOW);
          }
          client.println("<form action=\"led2\" method=\"get\">");
          client.println("<button type=submit style=\"width:200px;\">Foco 2 - "+statusLed+"</button>");
          client.println("</form> <br />");
          
          if(digitalRead(led3)) {
            statusLed = "Encendido";
          } else {
            statusLed = "Apagado";
          }
          client.println("<form action=\"led3\" method=\"get\">");
          client.println("<button type=submit style=\"width:200px;\">Foco 3 - "+statusLed+"</button>");
          client.println("</form> <br />");

          if(digitalRead(led4)) {
            statusLed = "Encendido";
            digitalWrite(led4,HIGH);
          } else {
            statusLed = "Apagado";
            digitalWrite(led4,LOW);
          }
          client.println("<form action=\"led4\" method=\"get\">");
          client.println("<button type=submit style=\"width:200px;\">Foco 4 - "+statusLed+"</button>");
          client.println("</form> <br />");

          if(digitalRead(led5)) {
            statusLed = "Encendido";
            digitalWrite(led5,HIGH);
          } else {
            statusLed = "Apagado";
            digitalWrite(led5,LOW);
          }
          client.println("<form action=\"led5\" method=\"get\">");
          client.println("<button type=submit style=\"width:200px;\">Foco 5 - "+statusLed+"</button>");
          client.println("</form> <br />");

          if(digitalRead(led6)) {
            statusLed = "Encendido";
            digitalWrite(led6,HIGH);
          } else {
            statusLed = "Apagado";
            digitalWrite(led6,LOW);
          }
          client.println("<form action=\"led6\" method=\"get\">");
          client.println("<button type=submit style=\"width:200px;\">Foco 6 - "+statusLed+"</button>");
          client.println("</form> <br />");

          if(digitalRead(led7)) {
            statusLed = "Encendido";
            digitalWrite(led7,HIGH);
          } else {
            statusLed = "Apagado";
            digitalWrite(led7,LOW);
          }
          client.println("<form action=\"led7\" method=\"get\">");
          client.println("<button type=submit style=\"width:200px;\">Foco 7 - "+statusLed+"</button>");
          client.println("</form> <br />");
          
          client.println("</center>");
          client.println("</body>");
          client.println("</html>");
          
          readString = "";
          
          client.stop();
        }
      }
    }
    
  }  
}
