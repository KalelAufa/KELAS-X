import java.util.Scanner;

public class project8 {
    public static void main(String[] args) {
        Scanner scanner = new Scanner(System.in);
        // user input
        System.out.print("Masukkan nilai pertama: ");
        double n1 = scanner.nextDouble(); // nilai pertama
        
        System.out.print("Masukkan nilai kedua: ");
        double n2 = scanner.nextDouble(); // nilai kedua
        
        System.out.print("Masukkan nilai ketiga: ");
        double n3 = scanner.nextDouble(); // nilai ketiga
        
        // Menghitung Rata-rata
        double average = (n1 + n2 + n3) / 3;
        
        // Output Rata-rata
        System.out.println("Rata-rata nilai: " + average);
        scanner.close();
    }
}
