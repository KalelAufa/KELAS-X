package balok;

import java.util.Scanner;

public class Mainbalok {
    public static void main(String[] args) {
        Balok balok = new Balok(0,0,0);
        Scanner input = new Scanner(System.in);
        System.out.print("Masukkan panjang balok: ");
        int panjang = input.nextInt();
        System.out.print("Masukkan lebar balok: ");
        int lebar = input.nextInt();
        System.out.print("Masukkan tinggi balok: ");
        int tinggi = input.nextInt();
        balok.setPanjang(panjang);
        balok.setLebar(lebar);
        balok.setTinggi(tinggi);

        System.out.println("Volume balok: " + balok.getPanjang() * balok.getLebar() * balok.getTinggi());
        
    }
}
