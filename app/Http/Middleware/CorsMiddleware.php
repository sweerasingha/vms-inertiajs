<?php
namespace App\Http\Middleware;

use Closure;

class CorsMiddleware
{
    /**
     * The array of allowed origins.
     *
     * @var array
     */
    protected $allowedOrigins = ['http://127.0.0.1:8000', 'http://localhost:8000'];

    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        \Log::info('CorsMiddleware is running');

        $origin = $request->headers->get('Origin');
        $response = $request->isMethod('OPTIONS') ? response('', 200) : $next($request);
        return $this->addCorsHeaders($response, $origin);
    }

    /**
     * Add CORS headers to the response.
     *
     * @param \Symfony\Component\HttpFoundation\Response $response
     * @param string|null $origin
     * @return \Symfony\Component\HttpFoundation\Response
     */
    protected function addCorsHeaders($response, $origin)
    {
        if (in_array($origin, $this->allowedOrigins)) {
            $response->headers->set('Access-Control-Allow-Origin', $origin);
        }

        $response->headers->set('Access-Control-Allow-Methods', 'POST, GET, OPTIONS, PUT, DELETE');
        $response->headers->set('Access-Control-Allow-Headers', 'Content-Type, Accept, Authorization, X-Requested-With, Application');

        // Only set to 'true' if you need to handle credentials
        $response->headers->set('Access-Control-Allow-Credentials', 'true');

        return $response;
    }
}
