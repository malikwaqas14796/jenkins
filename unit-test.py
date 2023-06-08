def check_python_syntax(code):
    try:
        compile(code, filename='<string>', mode='exec')
        print("Syntax check passed.<br><br><br>")
    except SyntaxError as e:
        raise SyntaxError("Syntax check failed.<br><br><br>")

# Provide your Python code here
python_code = '''
def greet():
    print("Hello, world!")
greet()
'''

# Check the syntax of the Python code
check_python_syntax(python_code)