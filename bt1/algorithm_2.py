count = -1
def equal(x, y):
	global count	
	count +=1
	for i in range(0, 1):
		if x == y:
			break
		else:
			if x * 2 < y:
				x *=2
				equal(x, y)
			elif x * 2 == y:
				x *=2
				equal(x, y)
			elif x * 2 -1 == y:
				x = x * 2 - 1
				count +=1
				equal(x, y)
			else:
				x -=1
				equal(x, y)

equal(2, 11)
print("Number of steps: ", count)
