import java.util.Scanner;

class raport{
        int tugas;
        int uts;
        int uas;
    }

public class oop {
    /**
     * @param args
     */
    public static void main(String[] args) {
        raport siswa1 = new raport();
        Scanner inputUsers = new Scanner(System.in);
        System.out.print("Masukkan nilai tugas: ");
        siswa1.tugas = inputUsers.nextInt(); // nilai pertama
        System.out.print("Masukkan nilai uts: ");
        siswa1.uts = inputUsers.nextInt(); // nilai kedua
        System.out.print("Masukkan nilai uas: ");
        siswa1.uas = inputUsers.nextInt(); // nilai ketiga
        System.out.println();
        // siswa1.tugas = 80;
        // siswa1.uts = 90;
        // siswa1.uas = 85;
        System.out.println("Nilai Tugas : " + siswa1.tugas);
        System.out.println("Nilai UTS : " + siswa1.uts);
        System.out.println("Nilai Uas : " + siswa1.uas);
        System.out.println("Rata-rata : " + (siswa1.tugas + siswa1.uts + siswa1.uas) / 3);
    }
}
