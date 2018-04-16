package xyz.data471.invasivespecies;

import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.webkit.WebSettings;
import android.webkit.WebView;
import android.webkit.WebViewClient;
// Used https://developer.android.com/guide/webapps/webview.html documentation


public class InvasiveSpecies extends AppCompatActivity {

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_invasive_species);
        WebView invasiveSpec = (WebView) findViewById(R.id.webview);
        invasiveSpec.setWebViewClient(new WebViewClient());
        WebSettings appSettings = invasiveSpec.getSettings();

        appSettings.setJavaScriptEnabled(true);
        invasiveSpec.loadUrl("http://dataentry:EnterPassword1.@@www.data471.xyz");

    }
}
