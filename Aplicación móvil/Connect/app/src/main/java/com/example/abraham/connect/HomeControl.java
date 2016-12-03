package com.example.abraham.connect;

import android.content.Context;
import android.content.Intent;
import android.graphics.Color;
import android.net.ConnectivityManager;
import android.net.NetworkInfo;
import android.os.AsyncTask;
import android.os.Bundle;
import android.os.Handler;
import android.support.design.widget.NavigationView;
import android.support.v4.view.GravityCompat;
import android.support.v4.widget.DrawerLayout;
import android.support.v7.app.ActionBarDrawerToggle;
import android.support.v7.app.AppCompatActivity;
import android.support.v7.widget.SwitchCompat;
import android.support.v7.widget.Toolbar;
import android.view.Menu;
import android.view.MenuItem;
import android.view.View;
import android.widget.Button;
import android.widget.TextView;
import android.widget.Toast;

public class HomeControl extends AppCompatActivity implements NavigationView.OnNavigationItemSelectedListener{
    SwitchCompat btnLed1, btnLed2,btnLed3,btnLed4,btnLed5,btnLed6,btnLed7;
    Button btnDoor1On, btnDoor1Off, btnDoor2On, btnDoor2Off;
    TextView txtResult,txtResultDoor, txtResultDoor2;
    int indigoColor = Color.parseColor("#5c6bc0");

    final Handler handler = new Handler();

    @Override
    protected void onCreate(Bundle savedInstanceState) {

        super.onCreate(savedInstanceState);
        setContentView(R.layout.home_control);

        Toolbar toolbar = (Toolbar) findViewById(R.id.toolbar);
        setSupportActionBar(toolbar);


        DrawerLayout drawer = (DrawerLayout) findViewById(R.id.drawer_layout);
        ActionBarDrawerToggle toggle = new ActionBarDrawerToggle(
                this, drawer, toolbar, R.string.navigation_drawer_open, R.string.navigation_drawer_close);
        drawer.setDrawerListener(toggle);
        toggle.syncState();

        NavigationView navigationView = (NavigationView) findViewById(R.id.nav_view);
        navigationView.setNavigationItemSelectedListener(this);

        //Acciones de la automatización
        btnLed1 = (SwitchCompat)findViewById(R.id.btnLed1);
        btnLed2 = (SwitchCompat)findViewById(R.id.btnLed2);
        btnLed3 = (SwitchCompat)findViewById(R.id.btnLed3);
        btnLed4 = (SwitchCompat)findViewById(R.id.btnLed4);
        btnLed5 = (SwitchCompat)findViewById(R.id.btnLed5);
        btnLed6 = (SwitchCompat)findViewById(R.id.btnLed6);
        btnLed7 = (SwitchCompat)findViewById(R.id.btnLed7);
        txtResult = (TextView)findViewById(R.id.txtResult);
        txtResultDoor = (TextView)findViewById(R.id.txtResultDoor);
        txtResultDoor2 = (TextView)findViewById(R.id.txtResultDoor2);
        txtResultDoor = (TextView)findViewById(R.id.txtResultDoor);

        btnDoor1On = (Button)findViewById(R.id.btnOn);
        btnDoor1Off = (Button)findViewById(R.id.btnOff);

        btnDoor2On = (Button)findViewById(R.id.btn2On);
        btnDoor2Off = (Button)findViewById(R.id.btn2Off);

        handler.postDelayed(actualizaEstado, 0);

        btnLed1.setOnClickListener(new View.OnClickListener(){
            @Override
            public void onClick(View v) {
                solicita("led1");
            }
        });
        btnLed2.setOnClickListener(new View.OnClickListener(){
            @Override
            public void onClick(View v) {
                solicita("led2");
            }
        });
        btnLed3.setOnClickListener(new View.OnClickListener(){
            @Override
            public void onClick(View v) {
                solicita("led3");
            }
        });
        btnLed4.setOnClickListener(new View.OnClickListener(){
            @Override
            public void onClick(View v) {
                solicita("led4");
            }
        });
        btnLed5.setOnClickListener(new View.OnClickListener(){
            @Override
            public void onClick(View v) {
                solicita("led5");
            }
        });
        btnLed6.setOnClickListener(new View.OnClickListener(){
            @Override
            public void onClick(View v) {
                solicita("led6");
            }
        });
        btnLed7.setOnClickListener(new View.OnClickListener(){
            @Override
            public void onClick(View v) {
                solicita("led7");
            }
        });

        btnDoor1On.setOnClickListener(new View.OnClickListener(){
            @Override
            public void onClick(View v) {
                solicita("motor1");
                txtResultDoor.setText("Puerta abierta");
                Toast.makeText(HomeControl.this,"La puerta ha sido abierta",Toast.LENGTH_SHORT).show();
            }
        });
        btnDoor1Off.setOnClickListener(new View.OnClickListener(){
            @Override
            public void onClick(View v) {
                solicita("motor2");
                txtResultDoor.setText("Puerta cerrada");
                Toast.makeText(HomeControl.this,"La puerta ha sido cerrada",Toast.LENGTH_SHORT).show();
            }
        });
        btnDoor2On.setOnClickListener(new View.OnClickListener(){
            @Override
            public void onClick(View v) {
                solicita("motor3");
                txtResultDoor2.setText("Ventanas abiertas");
                Toast.makeText(HomeControl.this,"Las ventanas han sido abiertas",Toast.LENGTH_SHORT).show();
            }
        });
        btnDoor2Off.setOnClickListener(new View.OnClickListener(){
            @Override
            public void onClick(View v) {
                solicita("motor4");
                txtResultDoor2.setText("Ventanas cerradas");
                Toast.makeText(HomeControl.this,"Las ventanas han sido cerradas",Toast.LENGTH_SHORT).show();
            }
        });

    }
    @Override
    public boolean onCreateOptionsMenu(Menu menu) {
        getMenuInflater().inflate(R.menu.activity_index, menu);
        return true;
    }
    @Override
    public boolean onOptionsItemSelected(MenuItem item) {
        int id = item.getItemId();
        if (id == R.id.action_settings) {
            startActivity(new Intent(getBaseContext(), MainActivity.class)
                    .addFlags(Intent.FLAG_ACTIVITY_CLEAR_TOP | Intent.FLAG_ACTIVITY_SINGLE_TOP));

            finish();
            return true;
        }
        return super.onOptionsItemSelected(item);
    }
    @SuppressWarnings("StatementWithEmptyBody")
    @Override
    public boolean onNavigationItemSelected(MenuItem item) {
        int id = item.getItemId();

        if (id == R.id.nav_control) {
            Intent i = new Intent(this, HomeControl.class);
            startActivity(i);
        }else if (id == R.id.nav_notes) {
            Intent i = getPackageManager().getLaunchIntentForPackage("com.herprogramacion.iwish");
            startActivity(i);
        } else if (id == R.id.nav_send) {
            Intent i = new Intent(this, Comment.class);
            startActivity(i);
        } else if(id == R.id.nav_intro){
            PrefManager prefManager = new PrefManager(getApplicationContext());
            prefManager.setFirstTimeLaunch(true);
            startActivity(new Intent(HomeControl.this,WelcomeActivity.class));
            finish();
        } else if (id == R.id.nav_devs) {
            Intent i = new Intent(this,Developers.class);
            startActivity(i);
        }
        DrawerLayout drawer = (DrawerLayout) findViewById(R.id.drawer_layout);
        drawer.closeDrawer(GravityCompat.START);
        return true;
    }
    //Recuperar la ip
    public void solicita(String comando){
        ConnectivityManager connMgr = (ConnectivityManager)
                getSystemService(Context.CONNECTIVITY_SERVICE);
        NetworkInfo networkInfo = connMgr.getActiveNetworkInfo();

        String url = "http://192.168.1.177:8090/" + comando;

        if (networkInfo != null && networkInfo.isConnected()) {
            new DownloadWebpageTask().execute(url);
        } else {
            txtResult.setText("No hay ninguna conexión detectada");
        }
    }

    private Runnable actualizaEstado = new Runnable() {
        @Override
        public void run() {
            solicita("");
            handler.postDelayed(this,1000);
        }
    };

    //Tarea en segundo plano de descarga del html
    private class DownloadWebpageTask extends AsyncTask<String, Void, String> {
        @Override
        protected String doInBackground(String... urls) {
            Conexion conexion = new Conexion();
            return conexion.getArduino(urls[0]);
        }
        @Override
        protected void onPostExecute(String result) {

            if(result != null){
                txtResult.setText("Conexión establecida :'D");
                if(result.contains("Foco 1 - Encendido")){
                    btnLed1.setChecked(true);
                }else if(result.contains("Foco 1 - Apagado")){
                    btnLed1.setChecked(false);
                }
                if(result.contains("Foco 2 - Encendido")){
                    btnLed2.setChecked(true);
                }else if(result.contains("Foco 2 - Apagado")){
                    btnLed2.setChecked(false);
                }
                if(result.contains("Foco 3 - Encendido")){
                    btnLed3.setChecked(true);
                }else if(result.contains("Foco 3 - Apagado")){
                    btnLed3.setChecked(false);
                }
                if(result.contains("Foco 4 - Encendido")){
                    btnLed4.setChecked(true);
                }else if(result.contains("Foco 4 - Apagado")){
                    btnLed4.setChecked(false);
                }
                if(result.contains("Foco 5 - Encendido")){
                    btnLed5.setChecked(true);
                }else if(result.contains("Foco 5 - Apagado")){
                    btnLed5.setChecked(false);
                }
                if(result.contains("Foco 6 - Encendido")){
                    btnLed6.setChecked(true);
                }else if(result.contains("Foco 6 - Apagado")){
                    btnLed6.setChecked(false);
                }
                if(result.contains("Foco 7 - Encendido")){
                    btnLed7.setChecked(true);
                }else if(result.contains("Foco 7 - Apagado")){
                    btnLed7.setChecked(false);
                }
            }else{
                txtResult.setText("No se puede recuperar la página, la url puede ser inválida o no hay una conexión. :(");
            }
        }
    }
}