#include <iostream>
using namespace std;

int main(){
    int h;
    float diskon;

    cout << "Masukkan Harga: ";
    cin >> h;



    if ( h >= 0){
        if( h >= 100000){
        diskon = h * 0.2;
        }else{
        diskon = 0 * 0.2;
        }

        cout << "Dapat Diskon: " << diskon << endl;
    }else {
        cout << "Harga Tidak Valid";
    }
    return 0;
}
