public class LK {
    public double HLuasPersegiPanjang(double panjang, double lebar) {
        return panjang * lebar;
    }
    public double HkelilingPersegiPanjang(double panjang, double lebar) {
        return 2 * (panjang + lebar);
    }
    public double HLuasCircle(double radius) {
        return Math.PI * radius * radius;
    }
    public double HkelilingCircle(double radius) {
        return 2 * Math.PI * radius;
    }
}
