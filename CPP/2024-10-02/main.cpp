#include <iostream>
#include <string>
using namespace std;

int main(){

    for (int i = 1; i <= 5; i++)
    {
        for (int j = 5 ; j >= i; j--)
        {
            cout << " * ";
        }
        cout << endl;
    }

cout << endl;
    
    for (int i = 1; i <= 5; i++)
    {
        for (int j = 1 ; j <= i; j++)
        {
            cout << " * ";
        }
        cout << endl;
    }

cout << endl;

    for (int i = 1; i <= 5; i++)
    {
        for (int j = 1; j < i; j++)
        {
            cout << "   ";
        }

        for (int k = 5; k >= i; k--)
        {
            cout << " * ";
        }
        cout << endl;
    }

cout << endl;

    for (int i = 1; i <= 5; i++)
    {
        for (int j = 5; j > i; j--)
        {
            cout << "   ";
        }

        for (int k = 1; k <= i; k++)
        {
            cout << " * ";
        }
        cout << endl;
    }
    
    

    return 0;
}