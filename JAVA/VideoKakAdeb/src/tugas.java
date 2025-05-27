import java.util.Scanner;

public class tugas {
    public void Luas(int p, int l){
        int Luas = p * l;
        System.out.println("Luas persegi panjang : " + Luas);
    }

    public static void main(String[] args) {
        tugas rpl = new tugas();
        Scanner input = new Scanner(System.in);
        System.out.print("Masukkan panjang: ");
        int panjang = input.nextInt();
        System.out.print("Masukkan lebar: ");
        int lebar = input.nextInt();
        rpl.Luas(panjang, lebar);
    }
}