#include <iostream>

int main()
{
    int array[100];

    for (int i = 0; i < 100; ++i)
    {
        array[i] = i + 1;
    }

    for (int i = 0; i < 100; ++i)
    {
        std::cout << "Array [" << i << "] = " << array[i] << std::endl;
    }

    return 0;
}


