#include <iostream>
using namespace std;
int main(){
    int n;
    cout << "Masukkan Nilai Anda: ";
    cin >> n;

    if (n >= 0 && n <= 100)
    {
        if (n >= 80 && n <= 100)
        {
            if (n >= 90 && n <= 100)
            {
                cout << "Nilai Anda A+" << endl;
            }
            else if (n >= 85 && n <= 89)
            {
                cout << "Nilai Anda A" << endl;
            }
            else
            {
                cout << "Nilai Anda A-" << endl;
            }
        }
        else if (n >= 65 && n <= 79)
        {
            if (n >= 75 && n <= 79)
            {
                cout << "Nilai Anda B+" << endl;
            }
            else if (n >= 70 && n <= 74)
            {
                cout << "Nilai Anda B" << endl;
            }
            else
            {
                cout << "Nilai Anda B-" << endl;
            }
        }
        else if (n >= 50 && n <= 64)
        {
            if (n >= 60 && n <= 64)
            {
                cout << "Nilai Anda C+" << endl;
            }
            else if (n >= 55 && n <= 59)
            {
                cout << "Nilai Anda C" << endl;
            }
            else
            {
                cout << "Nilai Anda C-" << endl;
            }
        }else if (n >= 40 && n <= 50)
        {
            cout << "Nilai Anda D" << endl;
        }else
        {
            cout << "Nilai Anda E" << endl;
        }
    }else
    {
        cout << "Nilai Anda Diluar Batas!!!" << endl;
    }
}