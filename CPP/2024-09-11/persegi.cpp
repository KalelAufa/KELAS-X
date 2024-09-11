#include <iostream>
using namespace std;

int main(){
    cout << "PERSEGI" << endl << endl;
    for (int i = 0; i < 5; ++i)
    {
        for (int j = 0; j < 50; ++j)
        {
            cout << "*";
        }
        cout << endl;
    }
    cout << "Panjang: 50" << endl;  
    cout << "Lebar: 5" << endl << endl;
    return 0;
}