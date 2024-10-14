#include <iostream>
using namespace std;

int main()
{
    int a = 0, b = 1, next = 0, n = 21;

    cout << "Fibonacci Series: ";

    for (int i = 1; i <= n; ++i)
    {
        // Prints the first two terms.
        if (i == 1)
        {
            cout << a << ", ";
            continue;
        }
        next = a + b;
        a = b;
        b = next;
        cout << next << ", ";
    }
    return 0;
}