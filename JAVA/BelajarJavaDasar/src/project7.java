public class project7 {
    public static void main(String[] args) {
        System.out.println("Looping Nama");
        for (int i = 0; i <= 3; i++) {
            System.out.print("Kalel ");
        }
        System.out.println();
        System.out.println();

        System.out.println("Segitiga");
        for (int i = 1; i <= 5; i++) {
            for (int j = 1; j <= i; j++) {
                System.out.print(" * ");
            }
            System.out.println();
        }
        System.out.println();
        for (int i = 5; i >= 1; i--) {
            for (int j = 1; j <= i; j++) {
                System.out.print(" * ");
            }
            System.out.println();
        }
        System.out.println();

        for (int i = 1; i <= 2; i++) {
            for (int  j= 1; j <= 3; j++) {
                        System.out.println(i+"."+j);
            }
            System.out.println();
        }

        
    }
}
