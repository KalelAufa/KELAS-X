#include <iostream>
using namespace std;
int main() {
    // int tb;
    // cout << "Masukkan Tinggi Badan (cm) : ";
    // cin >> tb;
    // cout << "Tinggi Badan (cm) : " << tb << endl;

    // // if (tb >= 165)
    // // {
    // //     cout << "Anda TInggi";
    // // }else
    // // {
    // //     cout << "Anda Kecil";
    // // }
    
    // // if (tb >= 180)
    // // {
    // //     cout << "Anda Tinggi";
    // // }else if (tb >= 165)
    // // {
    // //     cout << "Anda Ideal";
    // // }else{
    // //     cout << "Anda Kecil";
    // // }

    // if (tb >= 180)
    // {
    //     cout << "Anda Tinggi";
    // }if (tb >= 165)
    // {
    //     cout << "Anda Ideal";
    // }else
    // {
    //     cout << "Anda Kecil";
    // }

    int n;
    cout << "Masukkan Nilai : ";
    cin >> n;

    if ( n >= 90 && n <= 100 )
    {
        cout << "Nilai A";
    }else if (  n >= 80 && n <= 89)
    {
        cout << "Nilai A-";
    }else if ( n >= 70 && n <= 79)
    {
        cout << "Nilai B";
    }else if ( n >= 60 && n <= 69)
    {
        cout << "Nilai B-";
    }else if ( n >= 50 && n <= 59)
    {
        cout << "Nilai C";
    }else if ( n >= 40  && n <= 49)
    {
        cout << "Nilai C-";
    }else if ( n  >= 0 && n <= 39)
    {
        cout << "Nilai E";
    }else
    {
        cout << "Nilai di luar batas ";
    }
    return 0;
}