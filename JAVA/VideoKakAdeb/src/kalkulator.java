import java.util.Scanner;

public class kalkulator {
    public void tambah(float a, float b){
        float hasil = a + b;
        System.out.println("Hasil : " + hasil);
    }
    public void kurang(float a, float b){
        float hasil = a - b;
        System.out.println("Hasil : " + hasil);
    }
    public void kali(float a, float b){
        float hasil = a * b;
        System.out.println("Hasil : " + hasil);
    }
    public void bagi(float a, float b){
        float hasil = a / b;
        System.out.println("Hasil : " + hasil);
    }

    public static void main(String[] args) {
        kalkulator obj = new kalkulator();
        Scanner input = new Scanner(System.in);

        System.out.println("Masukkan Angka : ");
        float a =  input.nextFloat();
    }
}
