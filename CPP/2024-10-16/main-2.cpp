#include <iostream>
using namespace std;

int main(){
    int n;
    float potongan;
    int hasil;

    cout << "Masukkan Jumlah Pembelian Anda: ";
    cin >> n;

    if ( n >= 1000000)
    {
        potongan = n * 0.10;
        hasil = n - potongan;
    }else{
        potongan = 0;
        hasil = n - potongan;
    }

    cout << "Jumlah Pembelian Anda:  " << n << endl;
    cout << "Potongan yang Dikeluarkan:  " << potongan << endl;
    cout << "Jumlah yang Harus Dibayar:  " << hasil << endl;

    return 0;
}