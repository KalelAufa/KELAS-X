public class smkn2 {
    public static void main(String[] args) {
        XRPL object = new XRPL();
        System.out.println("Nama Saya adalah: " + object.nama);
        System.out.println("Alamat Saya adalah: " + object.alamat);
        System.out.println("Tahun lahir Saya adalah: " + object.thnlahir);
        System.out.println("Umur Saya adalah: " + object.umur);
        System.out.println();
        object.belajar();
        System.out.println();
        double menghitungnilai = object.nilai();
        System.out.println("Rerata Nilai XRPL" + menghitungnilai);
    }
}
