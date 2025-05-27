public class App {
    public void myMethod() {
        System.out.println("Hello RPL");
    }

    public void myNama(String nama){
        System.out.println("Nama :" + nama);
    }

    public void myData(int a){
        System.out.println("Data :" + a);
    }
    public static void main(String[] args) throws Exception {
        App obj = new App();
        obj.myMethod();
        obj.myNama("kalil");
        obj.myData(90);
    }
}
