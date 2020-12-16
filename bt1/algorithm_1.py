line = ["1"]
operator = ['+', "-"]
for i in range(2, 10):
	for j in range(len(line)):
		for op in operator:
			line.append(line[j] + op + str(i))
		line[j] += str(i)

for l in line:
	if (eval(l) == 100):
		print(l)