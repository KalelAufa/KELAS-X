#include <iostream>
using namespace std;

int main(){
    cout << "Masukkan Nilai Anda : ";
    int n;
    cin >> n;

    if (n >= 60)
    {
        cout << "Anda Dinyatakan Lulus";
    }else
    {
        cout << "Anda Di Bawah KKM";
    }
    return 0;
}