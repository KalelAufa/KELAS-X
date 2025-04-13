package kubus;

import java.util.Scanner;

public class Mainkubus {
    public static void main(String[] args) {
        Kubus kubus = new Kubus(0);
        Scanner input = new Scanner(System.in);

        System.out.print("Masukkan sisi baru: ");
        int sisi = input.nextInt();
        kubus.setSisi(sisi);

        System.out.println("Sisi Kubus: " + kubus.getSisi());

        int volume = (kubus.getSisi() * kubus.getSisi() * kubus.getSisi() );
        System.out.println("Volume Kubus: " + volume);
    }
}
