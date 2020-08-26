#Example : 0
============
#include <stdio.h>
int main() {    

    int number1, number2, sum;
    
    printf("Enter two integers: ");
    scanf("%d %d", &number1, &number2);

    // calculating sum
    sum = number1 + number2;      
    
    printf("%d + %d = %d", number1, number2, sum);
    return 0;
}

#Example : 1
============

#include <stdio.h>
int main()
{
    char ch;

    printf("\nEnter value of char\n");
    scanf("%c", &ch);

    printf("\nCharacter value of character = %c", ch);
    printf("\nASCII value = %d\n", ch);

    return 0;
}


#Example : 1
============
#include <stdio.h>  
int main()  
{  
    char ch;    // variable declaration  
    printf("Enter a character");  
    scanf("%c",&ch);  // user input  
    printf("\n The ascii value of the ch variable is : %c", ch);  
    printf("\n The ascii value of the ch variable is : %d", ch);  
    return 0;  
}


#Example : 2
============
#include<stdio.h>  
void main ()  
{  
    char s[30];  
    printf("Enter the string? ");  
    gets(s);  
    printf("You entered %s",s);  
}


#include<stdio.h>  
void main()   
{   
   char str[20];   
   printf("Enter the string? ");  
   fgets(str, 20, stdin);   
   printf("%s", str);   
}   


#Example : 4
============
#include <stdio.h>  
int main()  
{  
    int sum=0;  // variable initialization  
    char name[20];  // variable initialization  
    int i=0;  // variable initialization  
    printf("Enter a name: ");  
    scanf("%s", name);  
    while(name[i]!='\0')  // while loop  
    {  
        printf("\nThe ascii value of the character %c is %d", name[i],name[i]);  
        sum=sum+name[i];  
        i++;  
    }  
    printf("\nSum of the ascii value of a string is : %d", sum);  
    return 0;  
} 


#Example : 5
============

#include<stdio.h>  
#include <string.h>    
	int main(){    
	char name[50];    
	printf("Enter your name: ");    
	gets(name); //reads string from user    
	printf("Your name is: ");    
	puts(name);  //displays string    
	return 0;    
} 