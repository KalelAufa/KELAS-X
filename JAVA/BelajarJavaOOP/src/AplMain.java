import java.util.Scanner;

public class AplMain {
    public static void main(String[] args) {
        Scanner scanner = new Scanner(System.in);
        LK object = new LK();

        System.out.print("Masukkan panjang persegi panjang: ");
        double panjang = scanner.nextDouble();
        System.out.print("Masukkan lebar persegi panjang: ");
        double lebar = scanner.nextDouble();
        double HLuasP = object.HLuasPersegiPanjang(panjang, lebar);
        double HKelilingP = object.HkelilingPersegiPanjang(panjang, lebar);
        System.out.println("Luas Persegi Panjang: " + HLuasP);
        System.out.println("Keliling Persegi Panjang: " + HKelilingP);
System.out.println();
        System.out.print("Masukkan jari-jari lingkaran: ");
        double radius = scanner.nextDouble();
        double HLuasL = object.HLuasCircle(radius);
        double HKelilingL = object.HkelilingCircle(radius);
        System.out.println("Luas Lingkaran: " + HLuasL);
        System.out.println("Keliling Lingkaran: " + HKelilingL);

        scanner.close();
    }
}
