package projet.sig;

import org.hibernate.annotations.Type;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.data.relational.core.sql.In;
import org.springframework.http.ResponseEntity;
import org.springframework.ui.Model;
import org.springframework.web.bind.annotation.*;
import org.springframework.web.servlet.function.EntityResponse;
import org.json.JSONException;
import org.json.JSONObject;

import java.io.*;
import java.net.URL;
import java.nio.charset.Charset;
import java.util.*;

@RestController
@RequestMapping("/connexion")
public class ControllerSig {
    @Autowired
    private SigConnexionRepository sigConnexionRepository;

   @GetMapping("/voir")
    public List<SigConnexion> getAllConnexion(){
        return sigConnexionRepository.findAll();
    }

    private static String readAll(Reader rd) throws IOException {
        StringBuilder sb = new StringBuilder();
        int cp;
        while ((cp = rd.read()) != -1) {
            sb.append((char) cp);
        }
        return sb.toString();
    }

    public static JSONObject readJsonFromUrl(String url) throws IOException, JSONException {
        InputStream is = new URL(url).openStream();
        try {
            BufferedReader rd = new BufferedReader(new InputStreamReader(is, Charset.forName("UTF-8")));
            String jsonText = readAll(rd);
            JSONObject json = new JSONObject(jsonText);
            return json;
        } finally {
            is.close();
        }
    }
    @CrossOrigin(origins = "http://localhost:4200")
    @PostMapping("/enregistrer/{ville}")
    public void enregistrer(@PathVariable(value="ville") String ville,@RequestBody SigConnexion sigConnexion) throws JSONException, IOException {
        JSONObject json = readJsonFromUrl("https://geocode.xyz/"+ville+",Tunisia?json=1");
        Object longt=json.get("longt");
        Object latt=json.get("latt");
        System.out.println(longt);
        String l=String.valueOf(longt);
        System.out.println(l);
        String la=String.valueOf(latt);
        sigConnexion.setLongt(l);

        sigConnexion.setAltitude(la);
        System.out.println(sigConnexion.getTypes());
        System.out.println(sigConnexion.getVille());
        sigConnexionRepository.insertSig(sigConnexion.getTypes(),sigConnexion.getDebit(),
                sigConnexion.getSatisfait(),sigConnexion.getFournisseur(),sigConnexion.getEtat(),sigConnexion.getLongt(),sigConnexion.getAltitude(),ville);
    }



}
