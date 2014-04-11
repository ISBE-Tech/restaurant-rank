#python program implementing restaurant sorting algorithm
import json

if __name__ == '__main__':
	jsonfile = open('restaurants.json')
	restaurants = json.loads(jsonfile.read())['Restaurants']
	sortedrestaurants = []
	userrequest = {'price': 10,'steak': 5, 'shakes': 10, 'delivery': 0, 'pizza': 0, 'chicken': 0, 'mexican': 0, 'juice': 0, 'asian': 0}
	
	oprestaurant = opsum = float("inf")
	for restaurant in restaurants:
		sum = 0
		for name, attributes in restaurant.items():
			for attrib, value in userrequest.items():
				if attributes.has_key(attrib): 
					sum += (attributes[attrib] - value)**2 
				else:
					sum += value**2
		
		sortedrestaurants.append((sum, restaurant))
		if sum < opsum: 
			oprestaurant = restaurant
			opsum = sum
	
	def cmp_restaurants(a, b):
		return -1 if a[0] < b[0] else 1 if a[0] > b[0] else 0
	
	sortedrestaurants.sort(cmp_restaurants)
	sortedrestaurants = [k[1] for k in sortedrestaurants]
	
	output = open('user_response.json', 'w')
	output.write(json.dumps(sortedrestaurants))
	output.close()
	jsonfile.close()