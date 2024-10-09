#include <iostream>
using namespace std;

int main(){
    int t;
    cout << "Masukkan Tinggi : ";
    cin >> t;

    for (int i = 1; i <= t; i++)
    {
        for (int j = t; j >= i; j--)
        {
            cout << " * ";
        }
        cout << endl;
    }

    cout << endl;

    for (int i = 1; i <= t; i++)
    {
        for (int j = 1; j <= i; j++)
        {
            cout << " * ";
        }
        cout << endl;
    }

    cout << endl;

    for (int i = 1; i <= t; i++)
    {
        for (int j = 1; j < i; j++)
        {
            cout << "   ";
        }

        for (int k = t; k >= i; k--)
        {
            cout << " * ";
        }
        cout << endl;
    }

    cout << endl;

    for (int i = 1; i <= t; i++)
    {
        for (int j = t; j > i; j--)
        {
            cout << "   ";
        }

        for (int k = 1; k <= i; k++)
        {
            cout << " * ";
        }
        cout << endl;
    }
}
