package Eliza;

import java.util.HashMap;
import java.util.Map;
import java.util.Scanner;

public class eliza {

    /**
     * @param args
     */
    public static void main(String[] args) {
        // TODO Auto-generated method stub

        HashMap<String, String> theliza = new HashMap<String, String>();

        // Asigno palabras clave a respuesta
        theliza.put("HOLA", "Hola, ¿qué tal?");
        theliza.put("ENCANTADO", "Encantado de conocerte yo también");
        theliza.put("ADIOS", "Adiós, espero volverte a ver pronto");
        theliza.put("HORA", "Los siento no llevo reloj");
        theliza.put("NOMBRE", "Mi nombre es Eliza");
        theliza.put("CACA", "Creo que tu lenguaje no es adecuado");
        String otro = "Lo siento, no te comprendo.";

        Scanner sc = new Scanner(System.in);

        System.out.println("Estas conectado con el sistema ELIZA 0.0 :");
        boolean fin = false;
        do {
            System.out.print("<");
            String linea = sc.nextLine();
            // Paso todo a mayusculas;
            linea = linea.toUpperCase();

            boolean encontrado = false;
            for (Map.Entry<String, String> entrada : theliza.entrySet()) {
                // Si la linea contiene la entrada en al clave
                if (linea.contains(entrada.getKey())) {
                    System.out.println(">" + entrada.getValue());
                    encontrado = true;
                    if (entrada.getKey().contentEquals("ADIOS")) {
                        fin = true;
                    }
                    break;
                }
            }
            if (!encontrado) {
                System.out.println(otro);
            }
        } while (!fin);
        System.out.println(" Fin de conexión.");

    }
}