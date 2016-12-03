package com.example.abraham.connect;

import android.app.Activity;
import android.content.Intent;
import android.os.AsyncTask;
import android.os.Bundle;
import android.support.design.widget.NavigationView;
import android.support.v4.view.GravityCompat;
import android.support.v4.widget.DrawerLayout;
import android.support.v7.app.AppCompatActivity;
import android.view.Menu;
import android.view.MenuItem;
import android.view.View;
import android.widget.Button;
import android.widget.EditText;
import android.widget.Toast;

import org.apache.http.NameValuePair;
import org.apache.http.client.ClientProtocolException;
import org.apache.http.client.HttpClient;
import org.apache.http.client.entity.UrlEncodedFormEntity;
import org.apache.http.client.methods.HttpPost;
import org.apache.http.impl.client.DefaultHttpClient;
import org.apache.http.message.BasicNameValuePair;

import java.io.IOException;
import java.io.UnsupportedEncodingException;
import java.util.ArrayList;
import java.util.List;

public class Comment extends AppCompatActivity implements NavigationView.OnNavigationItemSelectedListener{

    private EditText nombre,correo,comentario;
    private Button enviar;


    @Override
    protected void onCreate(Bundle savedInstanceState) {

        super.onCreate(savedInstanceState);
        setContentView(R.layout.comments);

        nombre = (EditText)findViewById(R.id.editName);
        correo = (EditText)findViewById(R.id.editMail);
        comentario = (EditText)findViewById(R.id.editDesc);
        enviar = (Button)findViewById(R.id.btnSend);

        enviar.setOnClickListener(new View.OnClickListener(){
            @Override
            public void onClick(View v) {
                if(!nombre.getText().toString().trim().equalsIgnoreCase("")||
                        !correo.getText().toString().trim().equalsIgnoreCase("")||
                        !comentario.getText().toString().trim().equalsIgnoreCase(""))

                    new Insertar(Comment.this).execute();

                else
                    Toast.makeText(Comment.this, "Hay información por rellenar", Toast.LENGTH_LONG).show();
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
            startActivity(new Intent(Comment.this,WelcomeActivity.class));
            finish();
        } else if (id == R.id.nav_devs) {
            Intent i = new Intent(this,Developers.class);
            startActivity(i);
        }
        DrawerLayout drawer = (DrawerLayout) findViewById(R.id.drawer_layout);
        drawer.closeDrawer(GravityCompat.START);
        return true;
    }
    private boolean insertar(){
        HttpClient httpclient;
        List<NameValuePair> nameValuePairs;
        HttpPost httppost;
        httpclient=new DefaultHttpClient();
        httppost= new HttpPost("http://192.168.1.33/connect/Android/insertar.php");
        //Añadimos nuestros datos
        nameValuePairs = new ArrayList<NameValuePair>(4);
        nameValuePairs.add(new BasicNameValuePair("nombre",nombre.getText().toString().trim()));
        nameValuePairs.add(new BasicNameValuePair("correo",correo.getText().toString().trim()));
        nameValuePairs.add(new BasicNameValuePair("comentario",comentario.getText().toString().trim()));

        try {
            httppost.setEntity(new UrlEncodedFormEntity(nameValuePairs));
            httpclient.execute(httppost);
            return true;
        } catch (UnsupportedEncodingException e) {
            e.printStackTrace();
        } catch (ClientProtocolException e) {
            e.printStackTrace();
        } catch (IOException e) {
            e.printStackTrace();
        }
        return false;
    }
    class Insertar extends AsyncTask<String,String,String> {

        private Activity context;

        Insertar(Activity context){
            this.context=context;
        }
        @Override
        protected String doInBackground(String... params) {
            if(insertar())
                context.runOnUiThread(new Runnable(){
                    @Override
                    public void run() {
                        Toast.makeText(context, "Datos envíados con éxito.", Toast.LENGTH_LONG).show();
                        nombre.setText("");
                        correo.setText("");
                        comentario.setText("");
                    }
                });
            else
                context.runOnUiThread(new Runnable(){
                    @Override
                    public void run() {
                        Toast.makeText(context, "Hubo un fallo, verifica o intenta de nuevo.", Toast.LENGTH_LONG).show();
                    }
                });
            return null;
        }
    }
}