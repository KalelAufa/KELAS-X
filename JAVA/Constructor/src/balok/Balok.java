package balok;

public class Balok {
    private int P;
    private int L;
    private int T;

    //constructor
    public Balok(int p, int l, int t) {
        this.P = p;
        this.L = l;
        this.T = t ;
    }
    public int getPanjang() {
        return P;
    }
    public void setPanjang(int p) {
        this.P = p;
    }
    public int getLebar() {
        return L;
    }
    public void setLebar(int l) {
        this.L = l;
    }
    public int getTinggi() {
        return T;
    }
    public void setTinggi(int t) {
        this.T = t;
    }
}
