#include <iostream>

using namespace std;

int main()
{

    cout << "Perulangan For!" << endl;
    for (int i = 1; i <= 3; i++)
        for (int j = 1; j <= 5; j++)
        {
            cout << "ini i " << i << "ini j " << j << "ini adalah i j: " << "." << j;
            cout << endl;
        }
}
