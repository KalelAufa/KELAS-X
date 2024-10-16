#include <iostream>
using namespace std;

int main()
{
    cout << "Percabangan Nilai" << endl;

    cout << endl;
    cout << "Masukkan nilai: ";

    int n;
    cin  >> n;

    if (n>=65)
    {
        cout << "Nilai diatas KKM";
    }else
    {
        cout << "Nilai dibawah KKM";
    }
    
    

    return 0;
}