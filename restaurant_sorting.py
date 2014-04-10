#python program implementing restaurant sorting algorithm
import json, heapq

if __name__ == '__main__':
	jsonfile = open('restaurants.json')
	restaurants = json.loads(jsonfile.read())['Restaurants']
	heaprestaurants = []
	userrequest = {'price': 1, 'steak': 2, 'shakes': 10, 'chinese': 10, 'chicken': 10}
	
	oprestaurant = opsum = float("inf")
	for restaurant in restaurants:
		sum = 0
		for name, attributes in restaurant.items():
			for attrib, value in userrequest.items():
				if attributes.has_key(attrib): 
					sum += (attributes[attrib] - value)**2 
				else:
					sum += value**2
		
		heaprestaurants.append((sum, restaurant))
		if sum < opsum: 
			oprestaurant = restaurant
			opsum = sum
	
	heapq.heapify(heaprestaurants)
	sortedrestaurants = []
	for x in xrange(len(heaprestaurants)):
		sortedrestaurants.append(heapq.heappop(heaprestaurants))
	
	#sortedrestaurants = [r for v, r in sortedrestaurants]
	output = open('user_response.json', 'w')
	output.write(json.dumps(sortedrestaurants))
	output.close()
	jsonfile.close()