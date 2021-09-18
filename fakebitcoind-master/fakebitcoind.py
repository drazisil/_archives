from twisted.internet import reactor
from twisted.web import server
from twisted.web.resource import Resource

__author__ = 'drazisil'

class RcRoot(Resource):
    def __init__(self):
        Resource.__init__(self)

    # this code lets you call the resource as itself, as well as a parent
    def getChild(self, name, request):
        if name == '':
            return self
        return Resource.getChild(self, name, request)

    def render_POST(self, request):
        html = "<html>\n" \
                "<head>\n<title></title>\n"\
                "</head>" \
                "<body></body>\n</html>"
        return html

class WebServer:
    def __init__(self):
        site = server.Site(RcRoot())
        reactor.listenTCP(8330, site)
        print("Started listening on :8330")

if __name__ == "__main__":
	
	web = WebServer()
	reactor.run()